<?php
session_start();
require '../libraries/fpdf/fpdf.php';

// Incluye el archivo para cargar los datos del estudiante
require 'fetch_student_data.php'; // Asegúrate de que este archivo cargue los datos correctamente
// Verificar si hay datos del formulario en la sesión
if (!isset($_SESSION['formData'])) {
    echo 'No hay datos para generar el PDF.';
    exit();
}

$formData = $_SESSION['formData'];

// Verificar los datos del estudiante en la sesión
if (!isset($_SESSION['studentData'])) {
    echo 'Datos del estudiante no disponibles.';
    exit();
}

$studentData = $_SESSION['studentData'];

// Datos del estudiante
$userInfo = [
    'nombre_completo' => $_SESSION['session_fullname'],
    'telefono' => $formData['phone'] ?? 'No proporcionado',
    'correo_personal' => $formData['email'] ?? 'No proporcionado',
    'codigo_estudiante' => $_SESSION['session_codigo'],
   'correo_institucional' => $_SESSION['session_codigo'] . '@unfv.edu.pe', // Generar el correo institucional
    'escuela' => $studentData['escuela'] ?? 'No proporcionado',
    'semestre' => $studentData['semestre'] ?? 'No proporcionado'
];
// Generar el PDF con FPDF
class PDF extends FPDF
{

    function __construct($orientation='P', $unit='mm', $size='A4')
    {
        parent::__construct($orientation, $unit, $size);
        // Añadir la fuente
        $this->AddFont('ArialUnicodeFont', '', 'ArialUnicodeFont.php');
    }
    // Encabezado
    function Header()
    {
        // Logo izquierda
        $this->Image('../images/iconos/unfvLogoV.png', 15, 5, 50);
        // Logo derecha
        $this->Image('../images/iconos/logofiei_2021.png', 145, 5, 50);
        // Línea de separación
        $this->SetDrawColor(184, 116, 116);
        $this->SetLineWidth(1);
        $this->Line(10, 25, 200, 25); // Línea más arriba
        $this->Ln(15); // Ajustar el salto de línea
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('ArialUnicodeFont', '', 8);
        $this->Cell(0, 10, mb_convert_encoding('Jr. Iquique Nº 127 - Breña Central Telefónica 748-0888 Anexo 9872', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->Cell(0, 10, mb_convert_encoding('Página ' . $this->PageNo(), 'ISO-8859-1', 'UTF-8'), 0, 0, 'R');
    }

    // Título del capítulo con fondo
    function ChapterTitle($num, $label)
    {
        // Establecer color de fondo y texto
        $this->SetFillColor(83, 59, 57); // Color de fondo (hex: #533B39)
        $this->SetTextColor(255, 255, 255); // Color del texto blanco
        
        // Espacio adicional antes del rectángulo
        $this->Ln(2.5); // Ajusta este valor para mover el rectángulo hacia abajo
        
        // Rectángulo de fondo para el título
        $this->Rect(10, $this->GetY(), 190, 8, 'F'); // (x, y, ancho, alto, 'F' para fondo)
        
        // Título
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, "$label", 0, 1, 'C', false);
        
        // Salto de línea después del título
        $this->Ln(4); // Espacio después del título
    }

    // Título del diagnóstico sin fondo
    function DiagnosticTitle($label)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0); // Color del texto negro
        $this->Cell(0, 10, $label, 0, 1, 'L'); // Título alineado a la izquierda
        $this->Ln(0.5); // Espacio después del título
    }

    // Datos personales y académicos en dos columnas
    function PersonalAndAcademicData($userInfo)
    {
        $this->SetFont('Arial', 'B', 9); // Tamaño de fuente para títulos
        $this->SetTextColor(50, 60, 100);
        
        // Títulos de las columnas
        $this->Cell(90, 10, mb_convert_encoding('Datos Personales', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $this->Cell(90, 10, mb_convert_encoding('Información Académica', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');

        
        // Datos personales (columna izquierda)
        $this->SetFont('Arial', '', 9); // Tamaño de fuente para los datos
        $this->SetTextColor(0, 0, 0);
        $this->Cell(90, 8, 'Nombre completo: ' . $userInfo['nombre_completo'], 0, 1);
        $this->Cell(90, 8, mb_convert_encoding('Número de teléfono: ', 'ISO-8859-1', 'UTF-8') . $userInfo['telefono'], 0, 1);
        $this->Cell(90, 8, 'Correo personal: ' . $userInfo['correo_personal'], 0, 1);


        // Mover a la posición adecuada para la columna derecha
        $x = 103; // Posición X para la columna derecha
        $y = $this->GetY() - 24; // Posición Y para alinear con la columna izquierda
        
// Información académica (columna derecha)
$this->SetXY($x, $y);
$this->Cell(90, 8, mb_convert_encoding('Código de estudiante: ', 'ISO-8859-1', 'UTF-8') . $userInfo['codigo_estudiante'], 0, 1);
$this->SetXY($x, $y + 8);
$this->Cell(90, 8, 'Correo institucional: ' . $userInfo['correo_institucional'], 0, 1);
$this->SetXY($x, $y + 16);
$this->Cell(90, 8, mb_convert_encoding('Escuela: ', 'ISO-8859-1', 'UTF-8') . $userInfo['escuela'], 0, 1);
$this->SetXY($x, $y + 24);
$this->Cell(90, 8, mb_convert_encoding('Semestre: ', 'ISO-8859-1', 'UTF-8') . $userInfo['semestre'], 0, 1);
$this->Ln(0.5); // Espacio después de las columnas


    }

    // Mostrar preguntas y respuestas del formulario
    function FormResults($formData)
    {
        // Font para preguntas
        $this->SetFont('Arial', 'B', 10); // Fuente y tamaño para las preguntas
        $this->SetTextColor(0, 0, 0); // Color del texto negro
        
// Extraer preguntas y respuestas
$questions = [
    'emotion' => mb_convert_encoding('1. ¿Cómo te sientes emocionalmente en general?', 'ISO-8859-1', 'UTF-8'),
    'study_hours' => mb_convert_encoding('2. ¿Cuántas horas estudias por semana?', 'ISO-8859-1', 'UTF-8'),
    'performance_rating' => mb_convert_encoding('3. Del 1 al 10 ¿Cómo calificarías tu rendimiento académico?', 'ISO-8859-1', 'UTF-8'),
    'fisico' => mb_convert_encoding('4.¿Participas regularmente en actividades fisicas?', 'ISO-8859-1', 'UTF-8'),
    'afectivo' => mb_convert_encoding('5. ¿Te sientes apoyado en tus relaciones afectivas(familia, amigos, pareja, etc)?', 'ISO-8859-1', 'UTF-8'),
    'estres' => mb_convert_encoding('6. ¿Has experimentado niveles altos de estres o ansiedad recientemente?', 'ISO-8859-1', 'UTF-8'),
    'stress_management' => mb_convert_encoding('7. ¿Qué extrategias utilizas para manejar el estres o ansiedad?', 'ISO-8859-1', 'UTF-8'),
    'balance' => mb_convert_encoding('8. ¿Tienes un equilibrio adecuado entre el tiempo dedicado al estudio y tiempo libre?', 'ISO-8859-1', 'UTF-8'),
    'satisfaction' => mb_convert_encoding('9. ¿Cuál es tu nivel de satisfacción con tu experiencia universitaria?', 'ISO-8859-1', 'UTF-8'),

];

        
        foreach ($questions as $key => $question) {
            // Mostrar pregunta
            $this->Cell(0, 10, $question, 0, 1);
            // Mostrar respuesta
            $this->SetFont('Arial', '', 9); // Fuente para las respuestas
            $this->MultiCell(0, 10, isset($formData[$key]) ? $formData[$key] : 'No respondido', 0, 'L'); // Alineación a la izquierda
            $this->Ln(0.1); // Espacio entre cada pregunta y respuesta
            // Restablecer fuente para la siguiente pregunta
            $this->SetFont('Arial', 'B', 9); 
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
// Título del cuerpo
$pdf->ChapterTitle(1, 'FORMULARIO DE PSICOPEDAGOGIA FIEI');

// Mostrar datos personales y académicos en dos columnas
$pdf->PersonalAndAcademicData($userInfo);

// Título de resultados del diagnóstico
$pdf->DiagnosticTitle(mb_convert_encoding('Resultados de Diagnóstico de Psicopedagogía:', 'ISO-8859-1', 'UTF-8'));


// Mostrar preguntas y respuestas del formulario
$pdf->FormResults($_SESSION['formData']);

// Guardar el PDF en el servidor
$pdfFilePath = '../views/doc_pdf/resultados_encuesta.pdf';
$pdf->Output('F', $pdfFilePath);

// Redirigir para enviar el correo
header('Location: send_email.php');
exit();
?>

<?php

session_start();
require '../libraries/fpdf/fpdf.php';

// Verifica si los datos del formulario están en la sesión
if (!isset($_SESSION['tutoria_individual'])) {
    echo 'No hay datos para generar el PDF.';
    exit();
}

$formData = $_SESSION['tutoria_individual'];




// Verifica los datos del estudiante en la sesión
if (!isset($_SESSION['studentData'])) {
    echo 'Datos del estudiante no disponibles.';
    exit();
}

$studentData = $_SESSION['studentData'];

// Extraer el nombre del docente del arreglo $formData
$nombreDocente = isset($formData['teacher_name']) ? $formData['teacher_name'] : 'No especificado';

// Datos del estudiante
$userInfo = [
    'nombre_completo' => $_SESSION['session_fullname'],
    'telefono' => $formData['telefono'] ?? 'No proporcionado',
    'email' => $formData['email'] ?? 'No proporcionado',
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
        $this->Cell(90, 8, 'Correo personal: ' . $userInfo['email'], 0, 1);

        // Guardar la posición actual
        $currentX = $this->GetX();
        $currentY = $this->GetY();

        // Volver a la posición de inicio para datos académicos (columna derecha)
        $this->SetXY($currentX + 90, $currentY - 24);
        $this->Cell(90, 8, mb_convert_encoding('Código de estudiante: ', 'ISO-8859-1', 'UTF-8') . $userInfo['codigo_estudiante'], 0, 1);
        $this->SetXY($currentX + 90, $currentY - 16);
        $this->Cell(90, 8, 'Correo institucional: ' . $userInfo['correo_institucional'], 0, 1);
        $this->SetXY($currentX + 90, $currentY - 8);
        $this->Cell(90, 8, mb_convert_encoding('Escuela: ', 'ISO-8859-1', 'UTF-8') . $userInfo['escuela'], 0, 1);
        $this->SetXY($currentX + 90, $currentY);
        $this->Cell(90, 8, mb_convert_encoding('Semestre: ', 'ISO-8859-1', 'UTF-8') . $userInfo['semestre'], 0, 1);
    }

    // Mostrar preguntas y respuestas del formulario
    function FormResults($formData)
    {
        // Font para preguntas
        $this->SetFont('Arial', 'B', 10); // Fuente y tamaño para las preguntas
        $this->SetTextColor(0, 0, 0); // Color del texto negro
    

    
        // Extraer preguntas y respuestas
        $questions = [
            'tutoria' => mb_convert_encoding('1. Tipo de Tutoría:', 'ISO-8859-1', 'UTF-8'),
            'teacher_name' => mb_convert_encoding('2. Docente seleccionado:', 'ISO-8859-1', 'UTF-8'),
            'fecha' => mb_convert_encoding('3. Fecha para la tutoria:', 'ISO-8859-1', 'UTF-8'),
            'turno' => mb_convert_encoding('4. Turno para la tutoria:', 'ISO-8859-1', 'UTF-8'),
            'horas' => mb_convert_encoding('5. Rango de horas de la clase:', 'ISO-8859-1', 'UTF-8'),
            'cursos' => mb_convert_encoding('5. curso seleccionado:', 'ISO-8859-1', 'UTF-8'),
            'modalidad' => mb_convert_encoding('6. Modalidad de la tutoria:', 'ISO-8859-1', 'UTF-8'),
            'motivo' => mb_convert_encoding('7. Motivo de la solicitud:', 'ISO-8859-1', 'UTF-8'),
            'expectativas' => mb_convert_encoding('8. Expectativas de la tutoría:', 'ISO-8859-1', 'UTF-8'),
            'tiempo' => mb_convert_encoding('9. Tiempo disponible:', 'ISO-8859-1', 'UTF-8'),
            'recursos' => mb_convert_encoding('10. Recursos preferidos:', 'ISO-8859-1', 'UTF-8'),
            'requerimientos' => mb_convert_encoding('11. Requerimientos especiales:', 'ISO-8859-1', 'UTF-8')
        ];

        foreach ($questions as $key => $question) {
            // Mostrar pregunta
            $this->Cell(0, 10, $question, 0, 1);
            // Mostrar respuesta
            $this->SetFont('Arial', '', 9); // Fuente para las respuestas
            $response = isset($formData[$key]) ? $formData[$key] : 'No respondido';
            if ($key == 'tutoria') {
                // Convertir tipo de tutoría a descripción
                $response = $formData[$key] ?? 'No especificado';

            } elseif ($key == 'cursos') {
                // Convertir docente a nombre
                $response = $formData[$key] ?? 'No especificado';
            
            } elseif ($key == 'teacher_name') {
                // Convertir docente a nombre
                $response = $formData[$key] ?? 'No especificado';


            } elseif ($key == 'fecha') {
                // Asegúrate de que el formato de la fecha sea adecuado
                $response = date('d-m-Y', strtotime($formData[$key] ?? 'No especificado'));
            } elseif ($key == 'turno') {
                // Mapea el turno a texto descriptivo si es necesario
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'modalidad') {
                // Mapea la modalidad a texto descriptivo si es necesario
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'motivo') {
                // Muestra el motivo proporcionado
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'expectativas') {
                // Muestra las expectativas proporcionadas
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'preferencia') {
                // Muestra la preferencia proporcionada
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'tiempo') {
                // Muestra el tiempo disponible proporcionado
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'recursos') {
                // Muestra los recursos preferidos proporcionados
                $response = $formData[$key] ?? 'No especificado';
            } elseif ($key == 'requerimientos') {
                // Muestra los requerimientos especiales proporcionados
                $response = $formData[$key] ?? 'No especificado';
            }
            if (is_array($response)) {
                $response = implode(", ", $response);
            }
            // Convertir respuesta a ISO-8859-1
            $response = mb_convert_encoding($response, 'ISO-8859-1', 'UTF-8');
            $this->MultiCell(0, 10, $response, 0, 'L'); // Alineación a la izquierda
            $this->Ln(0.1); // Espacio entre cada pregunta y respuesta
            // Restablecer fuente para la siguiente pregunta
            $this->SetFont('Arial', 'B', 10); 
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
// Título del cuerpo
$pdf->ChapterTitle(1, mb_convert_encoding('SOLICITUD DE TUTORÍA', 'ISO-8859-1', 'UTF-8'));

// Mostrar datos personales y académicos en dos columnas
$pdf->PersonalAndAcademicData($userInfo);

// Título de resultados del diagnóstico
$pdf->DiagnosticTitle(mb_convert_encoding('Detalles de la solicitud de tutoría:', 'ISO-8859-1', 'UTF-8'));

// Mostrar preguntas y respuestas del formulario
$pdf->FormResults($formData);

// Guardar el PDF en el servidor
$pdfFilePath = '../views/doc_pdf/resultados_tutoria_individual.pdf';
$pdf->Output('F', $pdfFilePath);

// Redirigir para enviar el correo
header('Location: send_tutoria_email.php');
exit();



?>
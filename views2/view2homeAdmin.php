<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador - Home</title>
    <link rel="stylesheet" href="../assets/css/homeAdmin/estilosGenerales.css">
    <link rel="stylesheet" href="../assets/css/homeAdmin/sidebar.css">
    <link rel="stylesheet" href="contenedorCont.css">
    <link rel="stylesheet" href="../assets/css/homeAdmin/listEstudiante.css">
    <link rel="stylesheet" href="../assets/css/homeAdmin/add_student.css">
    <link rel="stylesheet" href="../assets/css/homeAdmin/listTutores.css">
    <link rel="stylesheet" href="../views2/add_tutor.css">
    <link rel="stylesheet" href="../views2/form_asignar_tutoria_grup.css">
    <link rel="stylesheet" href="../views2/ver_tutorias.css">


</head>
<body>
    <!--Aarchivo que se incluye en el body(el emcabezado)-->
    <?php include '../includes/headerHomeAdmin.php'; ?>

    <!--Contenedor General, que abarco el "sideBar" y el "contenedorContenido"-->
    <div class="container">

        <!--Contenedor para la barra lateral(SideBar) -->
        <nav class="sidebar">
            <ul id="listaDesordenada" >
                <li id="listaPrincipal">
                    <a href="#" class="menu-toggle" data-target="students-menu">
                        <span class="icon icon-students">🎓</span><b>GESTÍON DE ESTUDIANTES</b>
                    </a>
                    <ul id="students-menu" class="submenu">
                        <li><a href="#" id="lista-estudiantes">Lista de Estudiantes</a></li>
                        <li><a href="add-student" id="add-student">Agregar Estudiante</a></li>
                    </ul>
                </li>

                
                <li id="listaPrincipal">
                    <a href="#" class="menu-toggle" data-target="tutors-menu">
                        <span class="icon icon-tutors">👨‍🏫</span> <b>GESTÍON DE TUTORES</b>
                    </a>
                    <ul id="tutors-menu" class="submenu">
                        <li><a href="#" id="lista-tutores">Lista de Tutores</a></li>
                        <li><a href="agregar-tutor" id="agregar-tutor">Agregar Tutor</a></li>
                        <!--<li><a href="verDisponibilidad-tutor" id="verDisponibilidad-tutor">Ver disponibilidades de los tutores</a></li>-->
                    </ul>
                </li>

                <!--<li id="listaPrincipal">
                    <a href="#" class="menu-toggle" data-target="forms-menu">
                        <span class="icon icon-forms">📄</span><b>GESTÍON DE FORMULARIOS</b>
                    </a>
                    <ul id="forms-menu" class="submenu">
                        <li><a href="all_forms.php">Todos los Formularios</a></li>
                        <li><a href="approved_forms.php">Formularios Aprobados</a></li>
                        <li><a href="pending_forms.php">Formularios Pendientes</a></li>
                        <li><a href="rejected_forms.php">Formularios Rechazados</a></li>
                    </ul>
                </li>-->

                <!--ASIGNACION DE TUTORIAS-->
    <!-- Menú para seleccionar tipo de tutoría -->
    <li id="listaPrincipal">
        <a href="#" class="menu-toggle" data-target="tutoria-menu">
            <span class="icon icon-reports">📊</span><b>ASIGNAR TUTORIA</b>
        </a>
        <ul id="tutoria-menu" class="submenu">
            <li><a href="tutoria-grupal" id="tutoria-grupal">asignacion de tutorias</a></li>
            <li><a href="ver-tutorias" id="ver-tutorias">ver tutorias asignadas</a></li>
        </ul>
    </li>




               <!-- <li id="listaPrincipal">
                    <a href="#" class="menu-toggle" data-target="viewTutoria-menu">
                        <span class="icon icon-settings">⚙️</span><b>VER TUTORIAS</b> 
                    </a>
                    <ul id="viewTutoria-menu" class="submenu">
                        <li><a href="settings.php">Lista de tutorias</a></li>
                    </ul>
                </li>-->


            </ul>
        </nav>



        <!--ContenedorContenido, que mostrara informacion de los subtemas-->
        <main class="dashboard">
            <!--Se llama al contenedorContenidos que contendra la informacion que se presentara en esta parte-->
        <?php include '../views2/contenedorContenidos.php'; ?>
        
            
        </main>



    </div>

    <script src="../assets/js/homeAdmin/barralateral.js"></script>
    <script src="../assets/js/homeAdmin/listEstudiante.js"></script>
    <script src="../assets/js/homeAdmin/addStudent.js"></script>
    <script src="../assets/js/homeAdmin/listTutores.js"></script>
    <script src="../views2/addTutor.js"></script>
    <script src="../views2/asignar_tutoria_grupal.js"></script> <!-- Vincula el archivo JavaScript -->
    <script src="../views2/form_asignar_tutoria_grup.js"></script>
    <script src="../views2/ver_tutorias.js" defer></script> <!-- Script para manejar la tabla de tutorías -->
    <script src="../views3/verDisponibilidades.js"></script>
</body>
</html>

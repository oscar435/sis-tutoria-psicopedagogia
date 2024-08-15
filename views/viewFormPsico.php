<?php
session_start();
// Asegúrate de que el código y el nombre del estudiante estén disponibles
$studentCode = $_SESSION['session_codigo'] ?? '';
$studentName = $_SESSION['session_fullname'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENCUESTA DE DIAGNÓSTICO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Estilos adicionales -->
    <link rel="stylesheet" href="../assets/css/formPsico/formPsico1.css">
    <link rel="stylesheet" href="../assets/css/formPsico/emoticones1.css">
    <script src="../assets/js/slider.js"></script> <!-- Asegúrate de que esta ruta sea correcta -->
    <link rel="stylesheet" href="../assets/css/formPsico/slider1.css">
    

</head>
<body>
     <!-- Contenedor para la encuesta-->
     <div class="container"> 
             <h2>ENCUESTA DE DIAGNOSTICO</h2>
        <form id="surveyForm" action="process_form.php" method="POST">
            <!-- Campo oculto para el código del estudiante -->
            <input type="hidden" name="student_code" value="<?php echo htmlspecialchars($studentCode); ?>">

            <!-- Campo oculto para el nombre completo del estudiante -->
            <input type="hidden" name="student_name" value="<?php echo htmlspecialchars($studentName); ?>">

             <!-- Primera Pregunta -->    
             <label>¿Cómo te sientes emocionalmente en general?</label>
                 <div class="emoticones">            
                     <div class="emotion-buttons">
                         <input type="radio" id="very_bad" name="emotion" value="Muy mal">
                         <label for="very_bad" class="emotion-button emotion-very-bad">
                         <i class="fas fa-sad-tear"></i><br> Muy mal
                         </label>
                
                         <input type="radio" id="bad" name="emotion" value="Mal">
                         <label for="bad" class="emotion-button emotion-bad">
                         <i class="fas fa-sad-cry"></i><br> Mal
                         </label>
                
                         <input type="radio" id="regular" name="emotion" value="Regular">
                         <label for="regular" class="emotion-button emotion-regular">
                         <i class="fas fa-meh"></i><br> Regular
                         </label>
                
                         <input type="radio" id="good" name="emotion" value="Bien">
                         <label for="good" class="emotion-button emotion-good">
                         <i class="fas fa-smile"></i><br> Bien
                         </label>
                
                         <input type="radio" id="very_good" name="emotion" value="Muy bien">
                         <label for="very_good" class="emotion-button emotion-very-good">
                         <i class="fas fa-laugh-beam"></i><br> Muy bien
                         </label>
                     </div>
                 </div>


             <!-- Segunda Pregunta -->
             <label for="study_hours">Horas de estudio por semana</label><br>
                 <div class="slider">
                     <div class="slider-container">
                        <input type="range" id="study_hours" name="study_hours" min="0" max="100" value="0" oninput="updateSliderValue(this.value)">
                        <span id="sliderValue">0 horas</span>
                     </div>        
                 </div>


             <!-- Tercera pregunta -->
             <label for="performance_rating">Del 1 al 10, ¿cómo calificarías tu rendimiento académico actual?:</label><br>
                 <div class="escala">
                     <div class="rating-stars">
                         <!-- Cada estrella representa un valor del 1 al 10 -->
                         <input type="radio" id="rating1" name="performance_rating" value="1">
                         <label for="rating1" class="star">&#9733;</label>
        
                         <input type="radio" id="rating2" name="performance_rating" value="2">
                         <label for="rating2" class="star">&#9733;</label>
        
                         <input type="radio" id="rating3" name="performance_rating" value="3">
                         <label for="rating3" class="star">&#9733;</label>
        
                         <input type="radio" id="rating4" name="performance_rating" value="4">
                         <label for="rating4" class="star">&#9733;</label>
        
                         <input type="radio" id="rating5" name="performance_rating" value="5">
                         <label for="rating5" class="star">&#9733;</label>
        
                         <input type="radio" id="rating6" name="performance_rating" value="6">
                         <label for="rating6" class="star">&#9733;</label>
        
                         <input type="radio" id="rating7" name="performance_rating" value="7">
                         <label for="rating7" class="star">&#9733;</label>
        
                         <input type="radio" id="rating8" name="performance_rating" value="8">
                         <label for="rating8" class="star">&#9733;</label>
        
                         <input type="radio" id="rating9" name="performance_rating" value="9">
                         <label for="rating9" class="star">&#9733;</label>
        
                         <input type="radio" id="rating10" name="performance_rating" value="10">
                         <label for="rating10" class="star">&#9733;</label>
        
                         <!-- Contenedor para mostrar el número seleccionado -->
                           <span id="selected-number" class="selected-number">0</span>
                     </div>
                 </div>
                 <script>
                    document.querySelectorAll('.rating-stars input[type="radio"]').forEach(radio => {
                      radio.addEventListener('change', () => {
                      const selectedValue = document.querySelector('input[name="performance_rating"]:checked').value;
                      document.getElementById('selected-number').textContent = selectedValue;
                       });
                     });
                 </script>


             <!-- Cuarta pregunta -->
             <label for="fisico">¿Participas regularmente en actividades físicas:</label>
                 <div class="opcionesActividad">
                      <div class="options">
                        <button type="button" class="option-button" id="yes-btn" data-value="Si">Sí</button>
                        <button type="button" class="option-button" id="no-btn" data-value="No">No</button>
                      </div>
                      <input type="hidden" id="fisico" name="fisico">
                      <div id="response" class="response"></div>
                      <script src="../assets/js/optionfisic.js"></script>
                 </div>

             <!-- Quinta Pregunta -->
             <label for="afectivo">¿Te sientes apoyado/a en tus relaciones afectivas (familia, amigos, etc.)?</label><br>
                 <select id="afectivo" name="afectivo" required>
                     <option value="en blanco" selected disabled>Selecciona una opción</option>
                     <option value="Si">Si</option>
                     <option value="No">No</option>
                     <option value="En algunos casos">En algunos casos</option>
                 </select><br><br>


             <!-- Sexta pregunta -->
             <label for="estres">¿Has experimentado niveles altos de estrés o ansiedad recientemnete?</label><br>
                 <select id="estres" name="estres" required>
                     <option value="en blanco" selected disabled>Selecciona una opción</option>
                     <option value="Si">Si</option>
                     <option value="No">No</option>
                     <option value="A veces">A veces</option>
                 </select><br><br>


             <!-- Septima pregunta-->
             <label for="stress_management">Estrategias que utilizas para manejar el estrés o la ansiedad:</label><br>
                 <textarea id="stress_management" name="stress_management" rows="4" cols="50"></textarea><br><br>
         

             <!-- octava pregunta-->
             <label for="balance">¿Tienes un equilibrio adecuado entre el tiempo dedicado al estudio y tiempo libre?</label><br>
                 <div class="balance-options">
                     <input type="radio" id="yes" name="balance" value="Sí">
                     <label for="yes" class="option-button">Sí</label>

                     <input type="radio" id="no" name="balance" value="No">
                     <label for="no" class="option-button">No</label>

                     <input type="radio" id="in_process" name="balance" value="En proceso de encontrarlo">
                     <label for="in_process" class="option-button">En proceso de encontrarlo</label>

                    
                 </div>


             <!-- novena pregunta-->
             <label for="satisfaction">Nivel de satisfacción con tu experiencia universitaria:</label><br>
                 <select id="satisfaction" name="satisfaction" required>
                     <option value="en blanco" selected disabled>Selecciona una opción</option>
                     <option value="Muy insatisfecho">Muy insatisfecho</option>
                     <option value="Insatisfecho">Insatisfecho</option>
                     <option value="Neutral">Neutral</option>
                     <option value="Satisfecho">Satisfecho</option>
                     <option value="Muy satisfecho">Muy satisfecho</option>
                 </select><br><br>      
            
            
             <!-- Décima pregunta -->
             <label class="pregunta10" for="phone">¿Necesitas más información? Brindanos:</label><br>
                <div class="contact-info">
                   <div class="input-group1">
                      <label class="phoneTitle" for="phone">Número telefónico:</label>
                      <input type="tel" id="phone" name="phone" placeholder="000-000-000" required>
                   </div>
                  <div class="input-group2">
                      <label class="correoTitle" for="email">Correo personal:</label>
                      <input type="email" id="email" name="email" placeholder="ejemplo@gmail.com" required>
                  </div>
                </div>

         <input type="submit" value="Enviar Encuesta">
        
        </form>
        <!-- Script para la pregunta quinta pregunta, si no se seleciona nada mostrar mensaje emergente -->
        <script src="../assets/js/validate_emotion.js"></script>
        <script src="../assets/js/validate_afectivo.js"></script> 


     </div>
</body>
</html>
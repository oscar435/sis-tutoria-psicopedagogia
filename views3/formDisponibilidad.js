// formDisponibilidad.js
document.addEventListener('DOMContentLoaded', function () {
    const gestionButton = document.getElementById('btn-gestion-disponibilidad');
    const formContainer = document.getElementById('form-container');
  
    gestionButton.addEventListener('click', function (event) {
      event.preventDefault(); // Evita el comportamiento por defecto del enlace
  
      fetch('../views3/formDisponibilidad.php')
        .then(response => response.text())
        .then(data => {
          formContainer.innerHTML = data; // Actualiza el contenido del contenedor con el formulario
  
          // Completa los campos del formulario con los datos del docente
          document.getElementById('nombre-docente').value = window.docenteData.nombre;
          document.getElementById('apellido-docente').value = window.docenteData.apellido;
          document.getElementById('codigo-docente').value = window.docenteData.codigo;
        })
        .catch(error => {
          console.error('Error al cargar el formulario:', error);
        });
    });
  });
  
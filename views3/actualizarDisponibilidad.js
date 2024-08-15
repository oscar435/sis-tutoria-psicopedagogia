// actualizarDisponibilidad.js
document.addEventListener('DOMContentLoaded', function () {
    const actualizarButton = document.getElementById('btn-actualizar-disponibilidad');
    const formContainer = document.getElementById('form-container');
  
    actualizarButton.addEventListener('click', function (event) {
        event.preventDefault(); // Evita el comportamiento por defecto del enlace

        // Asume que tienes una forma de obtener el ID de disponibilidad, por ejemplo, desde un atributo data en el botón
        const disponibilidadId = actualizarButton.getAttribute('data-id'); // Asegúrate de definir este atributo en el HTML

        if (!disponibilidadId) {
            console.error('ID de disponibilidad no encontrado.');
            return;
        }

        fetch(`../views3/actualizarDisponibilidad.php?id=${disponibilidadId}`)
            .then(response => response.text())
            .then(data => {
                formContainer.innerHTML = data; // Actualiza el contenido del contenedor con el formulario
            })
            .catch(error => {
                console.error('Error al cargar el formulario:', error);
            });
    });
});

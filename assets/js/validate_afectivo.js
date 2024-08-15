
document.addEventListener('DOMContentLoaded', function() {
const form = document.querySelector('form'); // Asumiendo que hay solo un formulario en la página, o selecciona el formulario específico si hay más de uno
const afectivo = document.getElementById('afectivo');

form.addEventListener('submit', function(event) {
    if (afectivo.value === 'en blanco') {
        event.preventDefault(); // Evita el envío del formulario
        alert('Por favor, selecciona una opción para la pregunta sobre relaciones afectivas.');
        afectivo.focus(); // Enfoca el select para que el usuario vea dónde debe realizar la acción
    }
});
});
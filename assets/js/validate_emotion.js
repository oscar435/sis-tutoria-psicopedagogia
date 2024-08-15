document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('psychopedagogyForm');

    form.addEventListener('submit', function(event) {
        const emotionRadios = document.getElementsByName('emotion');
        let emotionSelected = false;
        for (const radio of emotionRadios) {
            if (radio.checked) {
                emotionSelected = true;
                break;
            }
        }
        if (!emotionSelected) {
            alert('Por favor, selecciona una opción para la pregunta sobre tu estado emocional.');
            event.preventDefault(); // Evita el envío del formulario
        }
    });
});

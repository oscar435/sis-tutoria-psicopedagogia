document.addEventListener('DOMContentLoaded', function() {
    const motivoSelect = document.getElementById('motivo');
    const motivoOtroTextarea = document.getElementById('motivo_otro');

    motivoSelect.addEventListener('change', function() {
        if (motivoSelect.value === 'Otro') {
            motivoOtroTextarea.style.display = 'block'; // Muestra el textarea
            motivoOtroTextarea.style.opacity = '1'; // Asegura que sea visible
            motivoOtroTextarea.style.height = 'auto'; // Ajusta la altura automáticamente
        } else {
            motivoOtroTextarea.style.opacity = '0'; // Hace el textarea invisible
            motivoOtroTextarea.style.height = '0'; // Reduce la altura a 0
            setTimeout(() => motivoOtroTextarea.style.display = 'none', 300); // Oculta el textarea después de la transición
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const expectativasSelect = document.getElementById('expectativas');
    const expectativasOtroTextarea = document.getElementById('expectativas_otro');

    expectativasSelect.addEventListener('change', function() {
        if (expectativasSelect.value === 'Otro') {
            expectativasOtroTextarea.style.display = 'block';
            expectativasOtroTextarea.focus();
        } else {
            expectativasOtroTextarea.style.display = 'none';
        }
    });
});

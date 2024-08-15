document.addEventListener('DOMContentLoaded', function() {
    // Función para manejar la selección de botones
    function handleButtonClick(event) {
        const clickedButton = event.target;
        const buttonGroup = clickedButton.closest('.options') || clickedButton.closest('.balance-options');
        const hiddenInput = buttonGroup.nextElementSibling;
        
        // Remover clase 'selected' de todos los botones en el grupo
        buttonGroup.querySelectorAll('.option-button').forEach(button => {
            button.classList.remove('selected');
        });
        
        // Añadir clase 'selected' al botón clicado
        clickedButton.classList.add('selected');
        
        // Actualizar el valor del input oculto
        hiddenInput.value = clickedButton.getAttribute('data-value');
    }

    // Agregar event listener a todos los botones de opción
    document.querySelectorAll('.option-button').forEach(button => {
        button.addEventListener('click', handleButtonClick);
    });
});

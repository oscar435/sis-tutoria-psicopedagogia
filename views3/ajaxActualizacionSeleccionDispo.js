function cargarDisponibilidad(id) {
    const formContainer = document.getElementById('form-container');

    if (id) {
        const url = 'actualizarDisponibilidad.php?id=' + id;
        
        fetch(url)
            .then(response => response.text())
            .then(html => {
                // Extraer el contenido del formulario del HTML recibido
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;

                const form = tempDiv.querySelector('form'); // Seleccionar solo el formulario

                if (form) {
                    formContainer.innerHTML = ''; // Limpiar el contenedor
                    formContainer.appendChild(form); // Insertar el nuevo formulario
                } else {
                    formContainer.innerHTML = '<p>Error al cargar el formulario.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formContainer.innerHTML = '<p>Error al cargar el formulario.</p>';
            });
    } else {
        formContainer.innerHTML = ''; // Limpiar el contenedor si no se selecciona ninguna opción
    }
}

document.getElementById('teacher').addEventListener('change', function() {
    // Obtener el texto del docente seleccionado
    var selectedTeacher = this.options[this.selectedIndex].text;
    
    // Asignar el texto al campo oculto
    document.getElementById('teacher_name').value = selectedTeacher;

    // Depuración: Mostrar el valor asignado en la consola
    console.log("Nombre del docente asignado al campo oculto: " + selectedTeacher);
});

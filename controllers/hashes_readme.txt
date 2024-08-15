El hasheo de contraseñas es una práctica de seguridad que convierte contraseñas en texto plano en una representación cifrada, lo que protege las contraseñas en la base de datos y hace que sea mucho más difícil para los atacantes obtener las contraseñas originales incluso si acceden a la base de datos.

Sí, debes hashear las contraseñas para ambas tablas (estudiantes y administradores), utilizando un archivo de hasheo para cada tabla si tienes que hacerlo por separado. Esto asegura que todas las contraseñas, tanto de estudiantes como de administradores, estén protegidas de manera uniforme.

contraseñaAdmin:quispe789
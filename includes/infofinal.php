<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5fafc;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}

.section {
    margin: 50px 0;
}

h2 {
    font-size: 2em;
    color: #2a5d67;
}

p {
    font-size: 1.2em;
    line-height: 1.5;
    color: #333;
}

.highlight {
    color: #e47635;
    font-weight: bold;
}

.circle-image {
    width: 250px;
    height: 250px;
    border-radius: 50%;
    object-fit: cover;
    margin-top: 20px;
}

@media (min-width: 768px) {
    .container {
        display: flex;
        justify-content: space-around;
    }
    
    .section {
        width: 45%;
    }
}

.quote {
            text-align: center;
            font-size: 18px;
            color: #333;
            font-style: italic;
        }

    </style>
</head>
<body>
    <div class="quote">
        <p>"La vida es y siempre seguirá siendo una ecuación incapaz de resolver, pero tiene ciertos factores que conocemos." </p>
        <p>- Nikola Tesla -</p>
    </div>
    <div class="container">
        <div class="section">
            <h2>¿Que es la Tutoria Universitaria?</h2>
            <p>La tutoría universitaria  es un proceso de acompañamiento académico y personal
            que se ofrece a los estudiantes en el entorno universitario. Su objetivo principal es ayudar a los estudiantes a adaptarse 
            al ambiente universitario, mejorar su rendimiento académico, y desarrollar habilidades personales y profesionales.</p>
            <img src="../images/imagesFooter/estulaptop.png" alt="estudiando con laptop" class="circle-image">
        </div>

        <div class="section">
            <h2>Apoyos que brinda el programa</h2>
            <p>El apoyo que brinda el programa es desde el  <span class="highlight">Docente Tutor:</span>  Brindará ayuda y alternativas de solución para superar 
            el riesgo académico, las asesorías se realizarán de manera presencial y se coordinan mediante correo electrónico. 
            <span class="highlight">Servicio Psicopedagogía:</span> Brindará orientación personalizada mediante entrevistas y talleres presenciales o virtuales. </p>
            <img src="../images/imagesFooter/libro.png" alt="estudiando con libro" class="circle-image">
        </div>
        <div class="section">
            <h2>NOSOTROS </h2>
            <p>En la facultad de <span class="highlight">Ingeniería Electrónica e Informática</span>  la acción de tutoría y psicopedagogía esta orientada a programar, 
            supervisar, controlar, impulsar, promover y coordinar las tareas que permitan solucionar los problemas de tipo académico, personal y/o social que afectan el 
            desempeño y rendimiento formativo del estudiante universitario, promover de manera integral actividades con la oficina de bienestar universitario.</p>
            <img src="../images/imagesFooter/estulibre.png" alt="estudiando libre" class="circle-image">
        </div>
    </div>
</body>
</html>
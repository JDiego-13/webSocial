<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FR</title>
    <link rel="stylesheet" href="../archivosCss/reconocimientoCara.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" />
    
    <script src="../scripts/face-api.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
</head>
<body>
    <form action="../php/datosCara.php" method="post">
    <section id="recFac">
        
        <div id="recono">
            <div id="camara">
                <video onloadedmetadata="onPlay(this)" id="videoElement"
                autoplay muted playsinline></video>
                <canvas id="overlay"></canvas>
            </div>

            <div id="icono">
                <i class="fa-solid fa-face-smile"></i>
            </div>
            <div id="imagenC">
                <img src="../gifts/cargando.gif" alt="">
            </div>
            
        </div>
        
                
        <div id="textoSaber">
            <div id="informacion">
                <p>¡Descubre personas con rasgos similares a los tuyos! Tu privacidad es importante para nosotros.</p>
            </div>
            <div id="divBoton">
                <button id="btnContinuar" type="submit">Presionar primero</button>
                <a href="../index.php" id="btnContinuar">Presionar segundo</a>
                
            </div>
            <div id="tomandoDatos">
                <p>Comenzando con el reconocimiento facial...</p>
                <img src="../gifts/cargando.gif" alt="">
            </div>
        </div>
    </section>
    <script src="../scripts/script_webcam.js"></script>
    </form>

    
</body>
</html>
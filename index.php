<?php

    session_start();

    if(isset($_SESSION['usuario'])){
        header("location: htmlAphp/explorar.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FacialRec</title>
    <link rel="stylesheet" href="archivosCss/cssIndex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" />
    
</head>
<body>

    <main>
        
        <section id="inicioSesion">
            <div id="sobreFR">
                <h1>FacialRec</h1>
                <p>FacialRec, es una plataforma que utiliza tecnologia de reconocimiento facial para conectar a 
                    las personas que comparten rasgos similares, FacialRec te brinda una experiencia unica para 
                    conectar con otros de una manera completamente nueva.
                </p>
            </div>
            
            <div id="formD">
                <form action="php/login_usuario_be.php" method="post" id="formulario">
                    
                    <div id="iconoF"><i class="fa-solid fa-lock"></i></div>
                    <input type="email" placeholder="Correo electronico" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button id="iniciarSesion" class="boton">Iniciar sesión</button>
                    <!--<a href="">¿Olvidaste tu contraseña?</a>-->
                    <hr>
                    <a href="htmlAphp/crearCuenta.php" id="crearCuenta" class="boton">Crear cuenta</a>
                    
                </form>
            </div>
            
            
            
        </section>
        
        <section id="piePagina">
            <hr>
            <footer>
                © Todos los derechos reservados
            </footer>
            
        </section>
        
    </main>
    
</body>
</html>
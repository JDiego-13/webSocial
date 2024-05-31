<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor debes iniciar sesión");
                window.location = "../index.php";
            </script>
        ';
        session_destroy();
        die();
    }
    
    // Incluir el archivo de conexión a la base de datos.
    include('../php/conexion_be.php');
    // Consulta SQL para seleccionar todos los usuarios registrados.
    $sql = "SELECT df.ID_usuario, df.puntos_faciales, u.nombre, u.apellido, u.descripcion, u.link_IG, u.sexo 
            FROM datos_faciales df
            INNER JOIN usuarios u ON df.ID_usuario = u.id";
    $resultado = mysqli_query($conexion, $sql);

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" />
    <link rel="stylesheet" href="../archivosCss/cssExplorar.css">

    <title>FR (Explorar)</title>
</head>
<body>
    <section class="seccionT">
        <div id="panelI">
            <div id="divTitulo">
                <h1 id="facialRojo" class="nombrePW">Facial</h1><h1 class="nombrePW">Rec</h1>
            </div>
            <div id="navegar">
                <div class="irA">
                    <a href=""><i class="fa-solid fa-magnifying-glass"></i>       Explorar</a>
                </div>
                <!--<div class="irA">
                    <a href="/archivosHtml/mensajes.html"><i class="fa-solid fa-comments"></i>       Mensajes</a>
                </div>-->
                <div class="irA">
                    <a href="../htmlAphp/perfil.php"><i class="fa-solid fa-user"></i>       Perfil</a>
                </div>
            </div>        </div>
        <div class="lineaVertical">
            
        </div>
            <div id="panelD" style= "text-align: center; 
                                     width: 100%;
                                     padding: 20px">
                <div>
                    <a href="../php/cerrar_sesion.php">cerrar sesión.</a>
                    <h1>Explorar</h1>
                </div>
                <div id="perfiles_usuarios" style="text-align: center;">
                    <div style="overflow-y: auto; max-height: 500px;">
                        <?php
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                    // Mostrar los detalles del usuario en HTML
                                    echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
                                    echo "<p><strong>Nombre: </strong>" . (isset($fila['nombre']) ? $fila['nombre'] : 'No disponible') . "</p>";
                                    echo "<p><strong>Apellido: </strong>" . (isset($fila['apellido']) ? $fila['apellido'] : 'No disponible') . "</p>";
                                    echo "<p><strong>Descripcion: </strong>" . (isset($fila['descripcion']) ? $fila['descripcion'] : 'No disponible') . "</p>";
                                    echo "<p><strong>Instagram o link: </strong>" . (isset($fila['link_IG']) ? $fila['link_IG'] : 'No disponible') . "</p>";
                                    echo "<p><strong>Sexo: </strong>" . (isset($fila['sexo']) ? $fila['sexo'] : 'No disponible') . "</p>";
                                    echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        
        
    </section>
</body>
</html>
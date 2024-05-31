<?php
session_start();

if (!isset($_SESSION['usuario'])) {
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

$nombre = $_SESSION['usuario']['nombre'] ?? 'Nombre no disponible';
$descripcion = $_SESSION['usuario']['descripcion'] ?? 'Descripción no disponible';
$sexo = $_SESSION['usuario']['sexo'] ?? 'Sexo no disponible';
$idUsuario = $_SESSION['usuario']['id'];
//Consultar las fotos del usuario en sesion
$queryFotosUsuario = "SELECT fotoG FROM bd_fotos WHERE ID_usuarioF = '$idUsuario'";
$resultadoFotosUsuario = mysqli_query($conexion, $queryFotosUsuario);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" />
    <link rel="stylesheet" href="../archivosCss/perfil.css">
    <title>FR (Perfil)</title>
</head>
<body>
    <section class="seccionT">
        <div id="panelI">
            <div id="divTitulo">
                <h1 id="facialRojo" class="nombrePW">Facial</h1><h1 class="nombrePW">Rec</h1>
            </div>
            <div id="navegar">
                <div class="irA">
                    <a href="../htmlAphp/explorar.php"><i class="fa-solid fa-magnifying-glass"></i> Explorar</a>
                </div>
                <!--<div class="irA">
                    <a href="/archivosHtml/mensajes.html"><i class="fa-solid fa-comments"></i> Mensajes</a>
                </div>-->
                <div class="irA">
                    <a href=""><i class="fa-solid fa-user"></i> Perfil</a>
                </div>
            </div>
        </div>
        <div class="lineaVertical"></div>
        <!--PANEL DERECHO-->
        <div id="panelD">
            <div>
                <a href="../php/cerrar_sesion.php">cerrar sesión.</a>
            </div>
            <!--RECTANGULO DE PERFIL-->
            <div id="PerfilD">
                <div id="rectangulo">
                    <div class="datos">
                        <p><strong>Descripción: </strong> <?php echo htmlspecialchars($descripcion); ?></p>
                    </div>
                    <div class="datos">
                        <h2><strong>Nombre: </strong> <?php echo htmlspecialchars($nombre); ?></h2>
                        <p><strong>Género: </strong> <?php echo htmlspecialchars($sexo); ?></p>
                    </div>
                    <form action="../php/perfil_be.php" method="post" enctype="multipart/form-data">
                        <div class="datos">
                            <div id="contenedor_vista_previa">
                                <img src="" alt="presionaAqui" id="foto_usuario">
                            </div>
                            <input type="file" name="foto" id="foto" style="display: none;" accept="image/*">
                            <button type="submit">Subir foto</button>
                        </div>
                    </form>
                    <script>
                        document.getElementById('foto_usuario').onclick = function(){
                            document.getElementById('foto').click();
                        };

                        document.getElementById('foto').onchange = function(event){
                            const [file] = event.target.files;
                            if(file){
                                document.getElementById('foto_usuario').src = URL.createObjectURL(file);
                            }
                        };
                    </script>
                </div>
            </div>
            <!--ICONOS DEL USUARIO-->
            <div id="iconosP">
                <div class="imgBoton">
                    <a href=""><i class="fa-solid fa-camera"></i></a>
                </div>
                <div class="imgBoton">
                    <a href="../htmlAphp/perfilParecido.php"><i class="fa-solid fa-user-group"></i></a>
                </div>
            </div>
            <!--LINEA DE USUARIOS-->
            <hr id="lineaD">
            <div id="fotos_usuario" class="contenedorFotos">
                        <?php
                            while($fila = mysqli_fetch_assoc($resultadoFotosUsuario)){
                                echo"<img src='" . $fila['fotoG'] . "' alt='Foto(s)_del_usuario' class='fotoUsuario'>";
                            }
                        ?>
            </div>
        </div>
    </section>
</body>
</html>

<style>
    #foto_usuario{
        max-width: 100%; /* Establece el ancho máximo para que se ajuste al tamaño de su contenedor */
        max-height: 80px; /* Establece la altura máxima para limitar la altura de la imagen */
        margin-top: 10px; /* Espacio superior */
    }
    #contenedor_vista_previa{
        text-align: center; /* Centra la imagen horizontalmente */
    }
    .fotoUsuario{
        max-width: 400px;
        height: auto;
        margin: 10px;
    }
    .contenedorFotos{
        max-width: 100%;
        height: 300px; /* Altura máxima para el contenedor */
        overflow-y: auto;
        align-items: center;
    }
</style>

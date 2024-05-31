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
    $puntosFacialesUsuarioActual = $_SESSION['puntos_faciales'] ?? 'Rasgos faciales no disponibles';
    // Función para calcular la similitud (distancia euclidiana) entre dos vectores
    function calcularSimilitud($vector1, $vector2) {
    $array1 = json_decode($vector1, true);
    $array2 = json_decode($vector2, true);

    if (count($array1) != count($array2)) {
        return PHP_FLOAT_MAX; // Devolver una distancia muy grande si los vectores no son del mismo tamaño
    }

    $distancia = 0;
    foreach ($array1[0]['coordenadas'] as $index => $value) {
        $distancia += pow($value['_x'] - $array2[0]['coordenadas'][$index]['_x'], 2) + pow($value['_y'] - $array2[0]['coordenadas'][$index]['_y'], 2);
    }

    return sqrt($distancia);
}

// Consultar todos los usuarios y sus datos faciales
$consultaUsuarios = mysqli_query($conexion, "SELECT u.id, u.nombre, u.descripcion, u.sexo, u.link_IG, df.puntos_faciales 
                                              FROM usuarios u 
                                              INNER JOIN datos_faciales df ON u.id = df.ID_usuario");

$usuariosSimilares = [];

if ($consultaUsuarios) {
    while ($usuario = mysqli_fetch_assoc($consultaUsuarios)) {
        // Evitar comparar el usuario consigo mismo
        if ($usuario['id'] == $_SESSION['usuario']['id']) {
            continue;
        }
        
        // Calcular la similitud
        $similitud = calcularSimilitud($puntosFacialesUsuarioActual, $usuario['puntos_faciales']);
        
        // Añadir al array de usuarios similares si la similitud es alta (por ejemplo, distancia menor a un umbral)
        if ($similitud < 570) { // Puedes ajustar el umbral de similitud según tus necesidades
            $usuariosSimilares[] = $usuario;
        }
    }
}
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" />
    <link rel="stylesheet" href="../archivosCss/perfilAmigos.css">
    <title>FR (Amigos)</title>
</head>
<body>
    <section class="seccionT">
        <div id="panelI">
            <div id="divTitulo">
                <h1 id="facialRojo" class="nombrePW">Facial</h1><h1 class="nombrePW">Rec</h1>
            </div>
            <div id="navegar">
                <div class="irA">
                    <a href="../htmlAphp/explorar.php"><i class="fa-solid fa-magnifying-glass"></i>       Explorar</a>
                </div>
                <!--<div class="irA">
                    <a href="/archivosHtml/mensajes.html"><i class="fa-solid fa-comments"></i>       Mensajes</a>
                </div>-->
                <div class="irA">
                    <a href="../htmlAphp/perfil.php"><i class="fa-solid fa-user"></i>       Perfil</a>
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
                </div>
            </div>
            <!--ICONOS DEL USUARIO-->
            <div id="iconosP">
                <div class="imgBoton">
                    <a href="../htmlAphp/perfil.php"><i class="fa-solid fa-camera"></i></a>
                </div>
                <div class="imgBoton">
                    <a href=""><i class="fa-solid fa-user-group"></i></a>
                </div>
                
            </div>
            <!--LINEA DE USUARIOS-->
            <hr id="lineaD">
            <div>
                <p>puntos faciales del usuario</p>
                <button id="botonDescarga">Descargar datos faciales</button>
                <!--<ul>
                    <p><strong>Datos faciales: </strong> ?php echo htmlspecialchars($puntosFacialesUsuarioActual)?></p>
                </ul> -->
                <h2>Usuarios con rasgos similares:</h2>
            </div>
            <script>
                document.getElementById('botonDescarga').addEventListener('click', function(){
                    window.location.href ='../php/descargarDatosFaciales.php?id_usuario=<?php echo $idUsuario; ?>';
                })
            </script>
            <div class="datosUsuarios">
                <?php if (count($usuariosSimilares) > 0): ?>
                <div class="listaUsuarios">
                    <?php foreach ($usuariosSimilares as $usuarioSimilar): ?>
                    <div class="usuarioSimilar">
                        <p><strong>Nombre: </strong> <?php echo htmlspecialchars($usuarioSimilar['nombre']); ?></p>
                        <p><strong>Descripción: </strong> <?php echo htmlspecialchars($usuarioSimilar['descripcion']); ?></p>
                        <p><strong>Género: </strong> <?php echo htmlspecialchars($usuarioSimilar['sexo']); ?></p>
                        <p><strong>Instagram o link: </strong> <?php echo htmlspecialchars($usuarioSimilar['link_IG']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <p>No se encontraron usuarios con rasgos faciales similares.</p>
                <?php endif; ?>
            </div>
        
    </section>
</body>
</html>

<style>
    .datosUsuarios{
        display: flex;
        justify-content: center;  
        align-items: flex-start;  
        flex-direction: column; 
        padding: 0;               
        margin: 0;     
    }

.listaUsuarios{
        max-height: 250px;  
        overflow-y: auto;  
        width: 100%;
        padding: 0;         
        margin: 0;   
}

.usuarioSimilar {
    border: 1px solid #ccc; 
        padding: 10px;            
        margin-bottom: 5px;       
        background-color: #f9f9f9;
        width: 80%;               
        margin-left: auto;        
        margin-right: auto;
}
</style>
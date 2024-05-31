<?php
session_start();

include 'conexion_be.php';

$idUsuario = $_SESSION['usuario']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $foto = $_FILES['foto'];
    // Directorio donde se guardan las fotos
    $targetDir = "../fotos/";
    $targetFile = $targetDir . basename($foto["name"]);
    $imagenFT = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $formatoImagen = ["jpg", "jpeg", "png", "gif"];
    // Verificar el tipo de archivo
    if (in_array($imagenFT, $formatoImagen)) {
        // Mover el archivo subido al directorio de destino
        if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
            // Guardar la ruta de la foto en la base de datos
            $fotoG = $targetFile;
            // Modificar la consulta para insertar en la tabla bd_fotos
            $query = "INSERT INTO bd_fotos(ID_usuarioF, fotoG) VALUES ('$idUsuario', '$fotoG')";

            if (mysqli_query($conexion, $query)) {
                echo '
                    <script>
                        alert("Foto subida y guardada correctamente");
                        window.location = "../htmlAphp/perfil.php";
                    </script>
                ';
            } else {
                echo '
                    <script>
                        alert("Error al guardar la foto en la base de datos");
                        window.location = "../htmlAphp/perfil.php";
                    </script>
                ';
            }
        } else {
            echo '
                <script>
                    alert("Error al mover el archivo subido");
                    window.location = "../htmlAphp/perfil.php";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Tipo de archivo no permitido");
                window.location = "../htmlAphp/perfil.php";
            </script>
        ';
    }
} else {
    echo '
        <script>
            alert("No se ha enviado ningún archivo");
            window.location = "../htmlAphp/perfil.php";
        </script>
    ';
}
?>

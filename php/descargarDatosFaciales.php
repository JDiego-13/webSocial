<?php
include 'conexion_be.php';

// Validar el id_usuario
if (!isset($_GET['id_usuario']) || !is_numeric($_GET['id_usuario'])) {
    die("ID de usuario no válido.");
}

// Obtener el id del usuario desde la URL
$id_usuario = (int)$_GET['id_usuario'];

// Preparar y ejecutar la consulta
$sql = "SELECT puntos_faciales FROM datos_faciales WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $puntos_faciales = $row['puntos_faciales'];

    // Generar el archivo .txt
    $filename = "datos_faciales_usuario_$id_usuario.txt";
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename=' . $filename);
    echo $puntos_faciales;
} else {
    echo "No se encontraron datos faciales para el usuario con ID $id_usuario.";
}

// Cerrar la conexión y la declaración
$stmt->close();
$conexion->close();
?>

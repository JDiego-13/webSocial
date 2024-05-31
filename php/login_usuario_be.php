<?php

    session_start();

    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'
    AND contrasena='$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        //Usuario logeado correctamente
        $usuario = mysqli_fetch_assoc($validar_login);
        //Almacenar el usuario de la sesion
        $_SESSION['usuario'] = $usuario;
        // Almacenar el nombre y la descripción en la sesión
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['descripcion'] = $usuario['descripcion'];
        $_SESSION['sexo'] = $usuario['sexo'];
        
        //consultar datos faciales del usuario
        $idUsuario = $usuario['id'];
        $consultaDatosFaciales = mysqli_query($conexion, "SELECT puntos_faciales FROM datos_faciales WHERE ID_usuario='$idUsuario'");

    if ($consultaDatosFaciales && mysqli_num_rows($consultaDatosFaciales) > 0) {
        $datosFaciales = mysqli_fetch_assoc($consultaDatosFaciales);
        $puntosFaciales = $datosFaciales['puntos_faciales'];
        $_SESSION['puntos_faciales'] = $puntosFaciales;
    } else {
        // Manejar el caso donde no se encontraron datos faciales
        $_SESSION['puntos_faciales'] = null;
    }
        header("location: ../htmlAphp/explorar.php");
        exit;
    }else{
        echo '
            <script>
                alert("Correo o contraseña incorrecta, por favor verifique los datos introducidos");
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
?>
<?php

    include 'conexion_be.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $link_IG = $_POST['link_IG'];
    $contrasena = $_POST['contrasena'];
    $descripcion = $_POST['descripcion'];
    $anio = $_POST['anio'];
    $mes = $_POST['mes'];
    $dia = $_POST['dia'];
    $sexo = $_POST['sexo'];

    //Encriptar contraseña
    $contrasena = hash('sha512', $contrasena);

    $query = "INSERT INTO usuarios(nombre, apellido, correo, link_IG, contrasena, descripcion, anio, mes, dia, sexo)
              VALUES('$nombre', '$apellido', '$correo', '$link_IG', '$contrasena', '$descripcion', '$anio', '$mes', '$dia', '$sexo')";


    //Verificar que el correo no se repita
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }


    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        //Obtener el ID del usuario recién creado
        $id_usuario = mysqli_insert_id($conexion);
        echo '
        <script>
            alert("Usuario almacenado exitosamente");
            localStorage.setItem("id_usuario", ' . $id_usuario . '); 
            window.location = "../htmlAphp/reconocimientoCara.php";
        </script>';
    } else{
        echo'
            <script>
                alert("Intentelo de nuevo, usuario no almacenado");
                window.location = "../index";
            </script>
        ';
    }

    mysqli_close($conexion);

?>
<?php
        session_start();
        include 'conexion_be.php';
    
        // Obtener los datos JSON del cuerpo de la solicitud
        $data = file_get_contents("php://input");
        var_dump($data);
        if(empty($data)){
            die("No se recibieron los datos JSON.");
        }
        // Decodificar los datos JSON en un objeto o array asociativo
        $objeto = json_decode($data, true);
        // Imprimir el objeto o array asociativo para verificar
        var_dump($objeto);
        if($objeto === null){
            die("Error al decodificar los datos JSON.");
        }

        if (!empty($data)) {
            $objeto = json_decode($data, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Obteniendo el ID del usuario del primer objeto
                $id_usuario = isset($objeto[0]['id_usuario']) ? $objeto[0]['id_usuario'] : '';
                // Aquí puedes continuar con el resto de tu lógica
            } else {
                die("Error al decodificar los datos JSON: " . json_last_error_msg());
            }
        } else {
            die("No se recibieron los datos JSON.");
        }

        //Obtener el Id del usuario del primer objeto (ya que todos los puntos faciales pertenecen al mismo usuairo).
        $id_usuario = $objeto[0]['id_usuario'];

        //Escapar datos y cosntruir la consulta SQL.
        $puntosFaciales = mysqli_real_escape_string($conexion, json_encode($objeto));

        $query = "INSERT INTO datos_faciales(ID_usuario, puntos_faciales) 
                  VALUES ('$id_usuario','$puntosFaciales')";

        if(mysqli_query($conexion, $query)){
            echo'
            <script>
                alert("Se guardarón los datos faciales");
                window.location = "../htmlAphp/explorar.php";
            </script>';
        } else{
            echo'
            <script>
                alert("Datos faciales no guardados: ' . mysqli_error($conexion) . '");
            </script>';
        }

        //Cerrar la conexion a la base de datos si es necesario
        mysqli_close($conexion);

    ?>
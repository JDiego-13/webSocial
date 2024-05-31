<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FR (Crear cuenta)</title>
    <script src="../scripts/crearCuenta.js"></script>
    <link rel="stylesheet" href="../archivosCss/cssCrearCuenta.css">
    
</head>
<form action="../php/registro_usuario_be.php" method="post">
<body>
    <section id="registroSec">
        <div id="titulos">
            <h1 class="titulos" id="tituloP">Registrate</h1>
            <h3 class="titulos">Rellena los campos</h3>
            <hr class="separador">
        </div>
        
            <div id="cajasTexto">
                <div>
                    <input type="text" placeholder="Nombre" class="inputs" name="nombre">
                    <input type="text" placeholder="Apellido(s)" class="inputs" name="apellido">
                </div>
                <div>
                    <input type="email" placeholder="Correo" class="inputs" name="correo">
                    <input type="text" placeholder="Link ó IG de la persona" class="input" name="link_IG">
                </div>
                <div>
                    <input type="password" placeholder="Contraseña" class="inputs" name="contrasena">
                    <input type="text" placeholder="Descripcion sobre ti" class="inputs" name="descripcion">
                </div>
            </div>
            <div id="nacimientoI">
                <h5>Fecha de nacimiento</h5>
                <select id="year" name="anio">
                    <option value="">Año</option>
                </select>
                <select id="mes" name="mes">
                    <option value="">Mes</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <select id="dia" name="dia">
                    <option value="">Día</option>
                </select>
            </div>
            <div id="sexoI">
                <h5>Sexo</h5>
                <select id="sexo" name="sexo">
                    <option value="">Selecciona</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div id="registroT">
                <p>Al hacer clic en "Registrarse", aceptas nuestras Condiciones, la Política de privacidad 
                    y la Política de cookies.</p>
                    <button type="submit">Registrarse</button>
                
            </div>
        
    </section>
</body>
</form>
</html>
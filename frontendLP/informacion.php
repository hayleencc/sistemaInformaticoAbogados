<!DOCTYPE html>
<html lang="en">
<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    session_start();
    $api_url = 'http://localhost/backendLP/rest_resource_read.php';

        
    $json_data = file_get_contents($api_url);


    $response_data = json_decode($json_data, true);
    $id = intval($_REQUEST["boton2"]);

    $_SESSION['nro'] = $id;

    
    $id = $response_data[intval($id)-1]["nro"];
    
    $nombres = $response_data[intval($id)-1]["nombres"];
    $direccion = $response_data[intval($id)-1]["direccion"];
    $puntuacion = $response_data[intval($id)-1]["puntuacion"];
    $comentario = $response_data[intval($id)-1]["comentario"];
    if($comentario == null){
        $comentario = "No existen comentarios registrados";
    }
    if($puntuacion == null){
        $puntuacion = "No existe puntuación registrada";
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Informacion Abogado</title>
</head>
<body>
    <h1 class="titulo">Informacion Abogado</h1>
    <div class="container">
        <div class="align-horiz">
            <h4>Id: </h4>
            <h5><?= $id ?></h5>
        </div>
        <div class="align-horiz">
            <h4>Nombres y Apellidos: </h4>
            <h5><?= $nombres ?></h5>
        </div>
        <div class="align-horiz">
            <h4>Dirección: </h4>
            <h5><?= $direccion ?></h5>
        </div>
        <div class="align-horiz">
            <h4>Comentarios: </h4>
            <h5><?= $comentario ?></h5>
        </div>
        <div class="align-horiz">
            <h4>Puntuación: </h4>
            <h5><?= $puntuacion ?></h5>
        </div>
        <div class="cont-btn">
            <form action="calificacion.php" method="POST">
                <input class="boton-env" type="submit" name="boton2" value="Calificar"/>
            </form>

            <button class="boton-reg" onclick="location.href='principal.php'">Regresar</button>
        </div>
    </div>

</body>
</html>







<!DOCTYPE html>
<html lang="en">
<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    $curl = curl_init();
    session_start();
    $id =  intval($_SESSION['nro']);
    //echo $id;

    $api_url = 'http://localhost/backendLP/rest_resource_read.php';

        
    $json_data = file_get_contents($api_url);


    $response_data = json_decode($json_data, true);
    $matricula = $response_data[intval($id)-1]["matricula"];
    $nombres = $response_data[intval($id)-1]["nombres"];
    
    $puntuacion = $_POST["radio"];
    $mensaje = $_POST["mensaje"];
    
        
    if($puntuacion =! null && $mensaje != null){
        
        $post_data = ["where" => $id, "fields" => [["comentario" => $mensaje],["puntuacion" => intval($puntuacion)]]];
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/backendLP/rest_resource_update.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS => json_encode($post_data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/plain'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
    ?>  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>
<body>
    <h1 class="titulo">Calificación</h1>
    <div class="container">
        <div class="align-horiz">
            <h4>Matrícula: </h4>
            <h5><?= $matricula ?></h5>
        </div>
        <div class="align-horiz">
            <h4>Nombres: </h4>
            <h5><?= $nombres ?></h5>
        </div>
        <div class="align-horiz">
            <h4>Puntuación</h4>
            <form method="POST">
                <input type='radio' name='radio' value='1' checked/>1
                <input type='radio' name='radio' value='2'/>2
                <input type='radio' name='radio' value='3'/>3
                <input type='radio' name='radio' value='4'/>4
                <input type='radio' name='radio' value='5'/>5</br>
            </form>
        </div>
        <div class="align-horiz">
            <h4>Comentario</h4>
            <form method="POST">
                <p><textarea name="mensaje" cols="40" rows="5" placeholder="Agrega un comentario breve"></textarea></p>
                <div class="cont-btn">
                    <p><input class="boton-env" type="submit" value="Enviar" name="result"></p>
                    
                </div>
            </form>
        </div>
        <button  class="boton-reg" onclick="location.href='principal.php'">Regresar</button>
    </div>
</body>
</html>
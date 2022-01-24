<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Calificación</h1>
    
    <h4>Puntuación</h4>
    <form method="POST">
        <input type='radio' name='radio' value='1' checked/>1
        <input type='radio' name='radio' value='2'/>2
        <input type='radio' name='radio' value='3'/>3
        <input type='radio' name='radio' value='4'/>4
        <input type='radio' name='radio' value='5'/>5</br>
        <h4>Comentario</h4>

        <p><textarea name="mensaje" cols="40" rows="5" placeholder="Agrega un comentario breve"></textarea></p>

        <p><input type="submit" value="Enviar" name="result"></p>
    </form>
    <?php
    $curl = curl_init();
    session_start();
    $id =  intval($_SESSION['nro']);
    //echo $id;

    $api_url = 'http://localhost/backendLP/rest_resource_read.php';

        
    $json_data = file_get_contents($api_url);


    $response_data = json_decode($json_data, true);
    echo "<h4>Matrícula: </h4>";
    echo $response_data[intval($id)-1]["matricula"];
    echo "<br />";
    echo "<h4>Nombres: </h4>";
    echo $response_data[intval($id)-1]["nombres"];
    echo "<br />";

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

    /*if ($puntuacion =! null && $mensaje != null){
        foreach ($response_data as $key => $value) {
            if ($value['nro'] == $id) {
                $json_arr[$key]['puntuacion'] = $puntuacion;
                $json_arr[$key]['mensaje'] = $mensaje;
            }
        }
    }
    file_put_contents($api_url2, json_encode($response_data));
   /* $api_url = 'http://localhost/backendLP/rest_resource_update.php';
    $data = 
        "\"where\" : $id,
        \"fields\" : [
            {\"nombres\" : \"TAPIA ANGULO ENRIQUE OMAR\"}
        ]";
    
    $json_data = file_put_contents($api_url, $data);*/
    ?>  
</body>
</html>
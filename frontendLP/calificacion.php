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

    <?php

    $api_url = 'http://localhost/backendLP/rest_resource_read.php';

    // Read JSON file
    $json_data = file_get_contents($api_url);

    // Decode JSON data into PHP array
    $response_data = json_decode($json_data);


// Print data if need to debug
    foreach ($response_data as $user) {
        echo "numero: ".$user->nro;
        echo "<br />";
        echo "nombre: ".$user->nombres;
        echo "<br /> <br />";
    }
?>

</body>
</html>
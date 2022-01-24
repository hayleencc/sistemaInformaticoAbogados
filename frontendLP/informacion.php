<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>
    <h1>Principal</h1>

    <?php
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('" . $output . "' );</script>";
    }
    $api_url = 'http://localhost/backendLP/rest_resource_read.php';

    
    $json_data = file_get_contents($api_url);

    
    $response_data = json_decode($json_data);
    echo "<table>";
    echo "<tr>";
    echo "<th>Número</th>";
    echo "<th>Nombres</th>";
    echo "<th>Estado</th>";
    echo "</tr>";
    

    foreach ($response_data as $user) {
        
        echo "<form action=\"informacion.php\" method=\"POST\">";
        //echo "numero ".$user->nro; 
        //echo "<input type=\"submit\" name=\"boton2\" value=\"$user->nro\"/>";
        
        echo "<tr>";
        echo "<td><input type=\"submit\" name=\"boton2\" value=\"$user->nro\"/></th>";
        echo "<td>$user->nombres</th>";
        echo "<td>$user->estado</th>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
    //debug_to_console("hola");    
    ?>
    

</body>
</html>







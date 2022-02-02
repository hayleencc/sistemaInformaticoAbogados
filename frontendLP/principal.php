<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Principal</title>
</head>
<body>
    <h1 class="titulo">Principal</h1>

    <?php
    $api_url = 'http://localhost/backendLP/rest_resource_read.php';

    
    $json_data = file_get_contents($api_url);

    
    $response_data = json_decode($json_data);
    echo "<div class=\"center\">";
    echo "<table>";
    echo "<tr class=\"tr-encabezado\">";
    echo "<th>Id</th>";
    echo "<th>Nombres y Apellidos</th>";
    echo "<th>Estado</th>";
    echo "</tr>";
    

    foreach ($response_data as $user) {
        
        echo "<form action=\"informacion.php\" method=\"POST\">";
        //echo "numero ".$user->nro; 
        //echo "<input type=\"submit\" name=\"boton2\" value=\"$user->nro\"/>";
        
        echo "<tr class=\"tr-align\">";
        echo "<td class=\"container-id\"><input type=\"submit\" name=\"boton2\" value=\"$user->nro\" class=\"btn-id\"/></th>";
        echo "<td>$user->nombres</th>";
        echo "<td>$user->estado</th>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
    echo "</div>";
    //debug_to_console("hola");    
    ?>
    

</body>
</html>
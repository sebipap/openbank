<?php 
include('moviServer.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500i,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <title>OpenBank  - Transferencias</title>



</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo"><h1>↩ OpenBank</h1></div></a>
        <h2 style="color: #3388e0">Movimientos</h2>

        
        <div id="movimientos">
            <table>
                <?php

                    foreach ($transferencia as $value) {
                        echo $value;
                    }

                ?>
            </table>

        
        </div>





    
  

    </div>

</body>
</html>
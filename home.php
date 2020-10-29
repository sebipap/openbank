<?php include('actualizar.php'); 
if(!isset($username)){
    header('Location: index.php');
}
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
    <title>OpenBank  - Inicio</title>



</head>
<body>

    <div id="home">

    <a href="index.php"><h1>OpenBank</h1></a>
    <h2>
        <?php 

        echo"Hola, <a href='user.php'> $username </a>";

        ?>
    </h2>

        <div id="botones">

                <div id="fila1">
                    <a><div class="boton ars" >ARS <?php echo $pesos?> </div></a>  
                    <a><div class="boton usd" >USD <?php echo $dolares?> </div></a> 
                </div>

                <div id="fila2">
                    <a href="transferencias.php"><div class="boton tra">Transferencias</div></a> 
                    <a href="movimientos.php"><div class="boton movimientos">Movimientos</div></a>  
                    <a href="divisas.php"><div class="boton cambio">Divisas</div></a>  
                    <a href="qr.php"><div class="boton qr" style="background-image:url('https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo "http://sebipaps.tk/transferencias.php?userB=$username" ?>') ;">Recibir</div></a>
                    <!-- <a href="index.php"><div class="boton prestamos">Prestamos</div></a>      -->
                    

                </div>
 
      

           
           
            
            
        </div>
        

    </div>



</body>
</html>
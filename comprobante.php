<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500i,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <title>OpenBank  - Comprobante</title>
</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo">
            <h1>↩ OpenBank</h1>
        </div></a>
    



    <a href="transferencias.php"><div id="subtitulo"><h2>↩ Transferencias</h2></div></a>


    <div id="comprobante">
        <img src="imagenes/comprobante2.png">


        <?php 

        $monto = $_REQUEST['monto'];            
        $userB = $_REQUEST['recibidor'];            
        $mailB = $_REQUEST['mail'];         
        $idTransferencia = $_REQUEST['id'];     
        $moneda = $_REQUEST['moneda'];       


        echo"
        <h2> Transferiste $moneda $monto </h2>
        <h2> a $userB ($mailB) </h2>
        <h3>Envío N° $idTransferencia </h3> ";

        ?>
        

        <a href="home.php" ><button> Ok </button></a>
        
    </div>
    


</body>
</html>
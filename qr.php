<?php
include('actualizar.php');


$monto=$moneda=$qr="";


if (isset($_REQUEST['monto'])){
    $monto=$_REQUEST['monto'];}else{
        $monto="";
    }    

if (isset($_REQUEST['moneda'])){
    $moneda=$_REQUEST['moneda'];}else{
        $monto="";
    }

if($monto!="" and $moneda!=""){
    $qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http%3A%2F%2Fsebipaps.tk%2Ftransferencias.php%3FuserB%3D" . $username . "%26monto%3D" . $monto . "%26moneda%3D" . $moneda;
    
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
    <title>OpenBank  - Recibir</title>



</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo">
            <h1>↩ OpenBank</h1>
        </div></a>

    <a href="transferencias.php"><h2 style="color: #3388e0">Recibir</h2></a>

    
        <div id="transferencias">

        <form>
        Recibir Dinero<br>
        <input type="text" name="monto" placeholder="Monto" >
        <input list="moneda" name="moneda" placeholder="Moneda" style="width: 80px;">
            <datalist id="moneda">
                <option value="ARS"></option>
                <option value="USD"></option>
            </datalist>
        <button type="submit"> Continuar </button>
        </form>

        </div>

        <?php
        if($qr!=""){
            echo" 
        
            <div id='qr'>
            <h3>Leer codigo para pagar $moneda $monto</h3>
            <img src='$qr'>
            </div>
    
            ";
        }
        ?>

        


    </div>
   
</body>
</html>


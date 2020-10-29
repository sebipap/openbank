<?php

include('actualizar.php');
include('envioDinero.php');

$req_url = 'https://openexchangerates.org/api/latest.json?app_id=63c226267e8f4589a41ef17e42c7aeaa';
$response_json = file_get_contents($req_url);

$monedas = json_decode($response_json);
$promedio = $monedas->rates->ARS;

$compra = $promedio*1.05;
$venta = $promedio/1.05;

$compra = round($compra, 2);
$venta = round($venta, 2);

$monto=$moneda=$error="";

if (isset($_REQUEST['monto'])){
    $monto=$_REQUEST['monto'];}else{
        $monto="";
    }    

if (isset($_REQUEST['moneda'])){
    $moneda=$_REQUEST['moneda'];}else{
        $moneda="";
    }    

if (isset($_REQUEST['venderARS'])){
    $venderARS=$_REQUEST['venderARS'];}else{
        $venderARS="";
    }   
    
if (isset($_REQUEST['comprarUSD'])){
    $comprarUSD=$_REQUEST['comprarUSD'];}else{
        $comprarUSD="";
    }    
        


/////////////////////////////////


    if($venderARS!="" and $comprarUSD!=""){
        transferir($username, 'OpenBank', $venderARS, 'ARS');
        transferir('Openbank', $username, $comprarUSD, 'USD');
    }


    if($monto==""){
        $display = '
        <div id="transferencias">
    
        <a href="divisas.php"><button>↩ Volver </button></a>   <h3><br> Pesos a Dolares <br> </h3>
                
        
            <form>
                
                <input type="text" name="monto" placeholder="Monto" style="width: 250px;">
                <input list="moneda" name="moneda" placeholder="Moneda" style="width: 80px;">
                <datalist id="moneda">
                    <option value="ARS"></option>
                    <option value="USD"></option>
                </datalist>
    
    
                <button type="submit" style="margin-left: 73%;";> Continuar </button>
                
            </form>
    
            </div>';
    

    }else{

        if($moneda=="ARS"){

            if($pesos>=$monto){
                $USD = $monto/$compra;
                $USD = round($USD, 2);
                $ARS = $monto;
            }

        }
        elseif($moneda=="USD"){

            $monto = $monto*$compra;

            if($pesos>=$monto){
                $USD = $monto/$compra;
                $USD = round($USD, 2);
                $ARS = $monto;
            }

        }

        if($pesos>=$monto){
            $display = '
            <div id="transferencias">
        
            <a href="dolarCompra.php"><button>↩ Volver </button></a>  
                    
            
                <form>
                    
                    <h3> <br>Confrima la compra de USD ' . $USD .  ' a ARS ' . $ARS . '?</h3>
                    <input type="hidden" value="'. $USD .'" name="comprarUSD">
                    <input type="hidden" value="'. $ARS .'" name="venderARS">
        
        
                    <button type="submit" style="margin-left: 73%;";> Confirmar </button>
                    
                </form>
        
                </div>';
        }else{
            $error = "No hay fondos suficientes :(";

            $display = '
            <div id="transferencias">
        
            <a href="divisas.php"><button>↩ Volver </button></a>   <h3><br> Pesos a Dolares <br> </h3>
                    
            
                <form>
                    
                    <input type="text" name="monto" placeholder="Monto" style="width: 250px;">
                    <input list="moneda" name="moneda" placeholder="Moneda" style="width: 80px;">
                    <datalist id="moneda">
                        <option value="ARS"></option>
                        <option value="USD"></option>
                    </datalist>
        
        
                    <button type="submit" style="margin-left: 73%;";> Continuar </button>
                    
                </form>
        
                </div>';
        }


    }



    



//$error =  transferir($username, $userB, $monto, $moneda);

if($error!=""){$error = "<div class='error'>$error</div>";}



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
    <title>OpenBank  - Comprar Dolares</title>



</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo">
            <h1>↩ OpenBank</h1>
        </div></a>

    <a href="transferencias.php"><h2 style="color: #3388e0">Compra Dolares</h2></a>

   



    <?php 
    echo $display;
    echo $error;
    ?>

    </div>
   
</body>
</html>


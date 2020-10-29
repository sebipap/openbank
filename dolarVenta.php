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

if (isset($_REQUEST['venderUSD'])){
    $venderUSD=$_REQUEST['venderUSD'];}else{
        $venderUSD="";
    }   
    
if (isset($_REQUEST['comprarARS'])){
    $comprarARS=$_REQUEST['comprarARS'];}else{
        $comprarARS="";
    }    
        


/////////////////////////////////


    if($venderUSD!="" and $comprarARS!=""){
        transferir($username, 'OpenBank', $venderUSD, 'USD');
        transferir('Openbank', $username, $comprarARS, 'ARS');
    }


    if($monto==""){
        $display = '
        <div id="transferencias">
    
        <a href="divisas.php"><button>↩ Volver </button></a>   <h3><br> Dolares a Pesos <br> </h3>
                
        
            <form>
                
                <input type="text" name="monto" placeholder="Monto" style="width: 250px;">
                <input list="moneda" name="moneda" placeholder="Moneda" style="width: 80px;">
                <datalist id="moneda">
                    <option value="USD"></option>
                    <option value="ARS"></option>
                </datalist>
    
    
                <button type="submit" style="margin-left: 73%;";> Continuar </button>
                
            </form>
    
            </div>';
    

    }else{

        if($moneda=="USD"){

            if($dolares>=$monto){
                $USD = $monto;
                $ARS = $monto*$venta;
                $ARS = round($ARS, 2);
            }

        }
        elseif($moneda=="ARS"){

            $monto = $monto/$venta;

            if($dolares>=$monto){
                $USD = $monto;
                $ARS = $monto*$venta;
                $ARS = round($ARS, 2);
            }


        }

        if($dolares>=$monto){
            $display = '
        <div id="transferencias">
    
        <a href="dolarVenta.php"><button>↩ Volver </button></a>  
                
        
            <form>
                
                <h3> <br>Confrima la venta de USD ' . $USD .  ' a ARS ' . $ARS . '?</h3>
                <input type="hidden" value="'. $USD .'" name="venderUSD">
                <input type="hidden" value="'. $ARS .'" name="comprarARS">
    
    
                <button type="submit" style="margin-left: 73%;";> Confirmar </button>
                
            </form>
    
            </div>';
        }else{
            $error = "No hay fondos suficientes :(";

            $display = '
            <div id="transferencias">
        
            <a href="divisas.php"><button>↩ Volver </button></a>   <h3><br> Dolares a Pesos <br> </h3>
                    
            
                <form>
                    
                    <input type="text" name="monto" placeholder="Monto" style="width: 250px;">
                    <input list="moneda" name="moneda" placeholder="Moneda" style="width: 80px;">
                    <datalist id="moneda">
                        <option value="USD"></option>
                        <option value="ARS"></option>
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
    <title>OpenBank  - Vender Dolares</title>



</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo">
            <h1>↩ OpenBank</h1>
        </div></a>

    <a href="divisas.php"><h2 style="color: #3388e0">Venta Dolares</h2></a>

   



    <?php 
    echo $display;
    echo $error;
    ?>

    </div>
   
</body>
</html>


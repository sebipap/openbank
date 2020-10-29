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

    <?php 
        $req_url = 'https://openexchangerates.org/api/latest.json?app_id=63c226267e8f4589a41ef17e42c7aeaa';
        $response_json = file_get_contents($req_url);

        $monedas = json_decode($response_json);
        $promedio = $monedas->rates->ARS;

        $compra = $promedio*1.05;
        $venta = $promedio/1.05;

        $compra = round($compra, 2);
        $venta = round($venta, 2);


    ?>

</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo">
            <h1>↩ OpenBank</h1>
        </div></a>
    



    <h2 style="color: #3388e0">Divisas - Dolares Estadounidenses</h2>

    <a href="dolarCompra.php">
    <div id="compra">
        <?php
        echo "
        <h1>$$compra</h1>
        <h2>Comprar</h2>";
        ?>  
    </div>
    </a>

    
    <a href="dolarVenta.php">
    <div id="venta">
        <?php
        echo "
        <h1>$$venta</h1>
        <h2>Vender</h2>";
        ?>  
    </div>
    </a>




    
  

</div>





      

    </div>



</body>
</html>
<?php



include('db.php');
include('envioDinero.php');


// contactos frecuentes
include('moviServer.php');



$error=$nameB=$emailB=$idTransaccion=$moneda="";
$idB=$comprobante=0;


if (isset($_REQUEST['userB'])){
    $userB=$_REQUEST['userB'];}else{
        $userB="";
    }

if (isset($_REQUEST['monto'])){
    $monto=$_REQUEST['monto'];}else{
        $monto="";
    }    

if (isset($_REQUEST['moneda'])){
    $moneda=$_REQUEST['moneda'];}else{
        $monto="";
    }      


$user_check_query = "SELECT username, id, email FROM users WHERE username='$userB' or email='$userB' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
while($row = mysqli_fetch_array($result)) {
    $idB = $row['id']; 
    $nameB = $row['username']; 
    $emailB = $row['email']; 

}

    // FUNCION PARA EFECTUAR PAGOS
    //transferir($username, $userB, $monto, $moneda);




if($idB!="" and $userB!=$username){
    $display = '
    <div id="transferencias">

    <a href="transferencias.php"><button>↩ Volver </button></a>   <h3><br>Enviar a ' . $nameB .' (' . $emailB . ')<br> </h3>
            
    
        <form>
            
            <input type="text" name="monto" placeholder="Monto" style="width: 250px;">
            <input list="moneda" name="moneda" placeholder="Moneda" style="width: 80px;">
            <datalist id="moneda">
                <option value="ARS"></option>
                <option value="USD"></option>
            </datalist>
            <input type="hidden" name="idB" value="' . $idB . '">
            <input type="hidden" name="nameB" value="' . $nameB . '">
            <input type="hidden" name="userB" value="' . $userB . '">

            <button type="submit" style="margin-left: 73%;";> Enviar </button>
            
        </form>

        </div>';
}else{
    $display = '    <div id="transferencias">

    <form>
Enviar dinero a
    <input type="text" name="userB" placeholder="Nombre o Mail" >
    <button type="submit"> Continuar </button>
    </form>

</div>';
}

    



$error =  transferir($username, $userB, $monto, $moneda);

if($userB==$username and $username!="" and $userB!=""){
    $error = "No podes mandarte plata a vos mismo!";
}

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
    <title>OpenBank  - Transferencias</title>



</head>


<body>

    <div id="home">
    
        <a href="home.php"><div id="titulo">
            <h1>↩ OpenBank</h1>
        </div></a>

    <a href="transferencias.php"><h2 style="color: #3388e0">Transferencias</h2></a>

   



    <?php 
    echo $display;
    echo $error;
    ?>

    </div>
   
</body>
</html>


<?php 

include('db.php');
include('actualizar.php');

$pass_vieja=$pass_nueva=$pass_repetir=$error="";

if (isset($_REQUEST['pass_vieja'])){
    $pass_vieja=$_REQUEST['pass_vieja'];}

if (isset($_REQUEST['pass_nueva'])){
    $pass_nueva=$_REQUEST['pass_nueva'];}

if (isset($_REQUEST['pass_repetir'])){
    $pass_repetir=$_REQUEST['pass_repetir'];}

$M_pass_vieja = md5($pass_vieja);
$M_pass_nueva = md5($pass_nueva);
$M_pass_repetir = md5($pass_repetir);


$display = "Usuario: $username <br>
Mail: $email <br>";


if($pass_vieja!="" and $pass_nueva!="" and $pass_repetir!="" ){

    if($password == $M_pass_vieja){
        if($M_pass_nueva == $M_pass_repetir){
            
            $query = "UPDATE users
            SET `password` = '$M_pass_nueva'
            WHERE `username` = '$username' and `password` = '$M_pass_vieja'";
                mysqli_query($db, $query);
                $error = "Contraseña cambiada!";

        }else{
            $error = "Las contraseñas no coinciden";
        }
    }else{
        $error = "Esa no es tu contraseña anterior!";

    }

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
    <title>OpenBank  - Inicio</title>

</head>
<body>

    <div id="home">

    <a href="home.php"><h1>↩ OpenBank</h1></a>
    
    <div id="user">
        <form>

        



        <input type="password" name="pass_vieja" placeholder="Contraseña anterior">


        <input type="password" name="pass_nueva" placeholder="Contraseña nueva">



        <input type="password" name="pass_repetir" placeholder="Repetir contraseña nueva">

        <button type="submit"> Enviar </button>
        </form>

        <?php echo $error;?>


</body>
</html>
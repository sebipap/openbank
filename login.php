<?php

session_start();

    $login_name = $username= $password = $passwordReal = $error = "";
    $pesos = $dolares = 0;

    if (isset($_REQUEST['login_name'])){
        $login_name=$_REQUEST['login_name'];}

    if (isset($_REQUEST['password'])){
        $password=$_REQUEST['password'];}    



    include('db.php');
    $user_check_query = "SELECT password, username, id, pesos, dolares, email FROM users WHERE email='$login_name' or username='$login_name'LIMIT 1";
    $result = mysqli_query($db, $user_check_query);

    while($row = mysqli_fetch_array($result)) {
        $id = $row['id']; 
        $username = $row['username']; 
        $passwordReal = $row['password']; 
        $pesos = $row['pesos']; 
        $dolares = $row['dolares']; 
        $email = $row['email']; 


    }

    $password = md5($password);

    if ($username!="" and $password!="") {
        if($password==$passwordReal){


            $_SESSION["username"] = $username;   
            $_SESSION['id'] = $id;
            $_SESSION['pesos'] = $pesos;
            $_SESSION['dolares'] = $dolares;
            $_SESSION['email'] = $email;
            if($_SESSION){
                header('Location: home.php');       
            }    
            
                        
        }else{
            $error = "<div class='error'>Contraseña incorrecta!</div>";
        }

    }elseif($login_name!=""){
        $error = "<div class='error'>No existe ese usuario!</div>"; }
        


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
    <title>OpenBank  - Login</title>
</head>




<body>
    <div id="inicio">
            <h1>OpenBank</h1>
            <div id="form">
                <form id="login">

                    <div id="inputs">
                        <input type="text" name="login_name"placeholder="Nombre o Mail">
                        <input type="password" name="password"placeholder="Contraseña">
                    </div>



                    <?php echo $error ?>
                </form>    
                
                <div id="links">
                        <a href="index.php"><button>Volver</button></a>
                        <button type="submit" form="login">Entrar</button>
                    </div>

            </div>

        </div>
</body>



</html>
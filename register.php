<?php
include('server.php');
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
    <title>OpenBank  - Registro</title>
</head>




<body>
<div id="inicio">
        <h1>OpenBank</h1>
        <div id="form">
            <form method="post" action="register.php" id="register">
            
                <div id="inputs">
                    <input type="text" name="username" placeholder="Tu Nombre">
                    <input type="text" name="email" placeholder="Mail">
                    <input type="password" name="password_1" placeholder="Contraseña">
                    <input type="password" name="password_2" placeholder="Repetir Contraseña">
                </div>



                <?php include ('errors.php');?>

                
            </form>
                
            <div id="links">
                    
                    <a href="index.php"><button>Volver</button></a>
                    <button type="submit" name="reg_user" form="register"><div class="boton">Registrarme</div></button>
                    
                </div>

        </div>
        
       
    </div>
</body>
</html>
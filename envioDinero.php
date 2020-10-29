<?php





//funcion que vamos a llamar desde cualquier parte de la aplicacion
function transferir($user, $userB, $monto, $moneda){

    if($user=="OpenBank" or $userB == "Openbank"){
        $bancaria = True;
    }


    include('db.php');
    $error ="";



//sacamos los datos del que envia el dinero (user)

$user_check_query = "SELECT id, pesos, dolares FROM users WHERE username='$user' or email='$user' LIMIT 1";
$result = mysqli_query($db, $user_check_query);

while($row = mysqli_fetch_array($result)) {
    $id = $row['id']; 
    $pesos = $row['pesos'];
    $dolares = $row['dolares'];
}


//sacamos los datos del recibidor del dinero (userB)

$user_check_query = "SELECT id, pesos, dolares FROM users WHERE username='$userB' or email='$userB' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
while($row = mysqli_fetch_array($result)) {
    $idB = $row['id']; 
    $pesosB = $row['pesos'];
    $dolaresB = $row['dolares'];
}

if(isset($idB)) {

    //determinamos la fecha que vamos a poner en la planilla de transferencias
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fecha = date("YmdHis");


// efectuar transferencia

if(is_numeric ($monto) and $monto!=0){

    if($moneda == "ARS"){

        if($pesos>=$monto){

            $Nuevo_pesos = $pesos - $monto;
            $Nuevo_pesosB = $pesosB + $monto;
    
            // Actualizar patrimonio nuestro (pesos-monto)
    
            $user_check_query = "UPDATE users
            SET `pesos` = $Nuevo_pesos
            WHERE `id` = $id
            ";
    
            $result = mysqli_query($db, $user_check_query);
    
            // Actualizar el patrimonio del otro (pesosb + monto)
    
            $user_check_query = "UPDATE users
            SET `pesos` = $Nuevo_pesosB
            WHERE `id` = $idB
            ";
    
            $result = mysqli_query($db, $user_check_query);
    
            // insertar transaccion a la otra planilla
    
            $user_check_query = "INSERT INTO `transacciones`(`pagador`, `recibidor`, `pesos`, `dolares`, `fecha`) VALUES ('$user' , '$userB' , $monto , 0 , $fecha)";
            $result = mysqli_query($db, $user_check_query);
    
    
            $user_check_query = "SELECT id FROM `transacciones` WHERE `fecha`=$fecha";
            $result = mysqli_query($db, $user_check_query);
    
            while($row = mysqli_fetch_array($result)) {
                $idTransaccion = $row['id']; 
            }
    
            $user_check_query = "SELECT `username`, `email` FROM `users` WHERE id=$idB";
            $result = mysqli_query($db, $user_check_query);
    
            while($row = mysqli_fetch_array($result)) {
                $userB = $row['username']; 
                $emailB = $row['email']; 
            }
    
    
    
            $url = "comprobante.php?monto=$monto&recibidor=$userB&mail=$emailB&id=$idTransaccion&moneda=$moneda";
            header("Location: $url ");               
    
        }else{
            $error="No hay fondos suficientes";
        }

    }elseif($moneda == "USD"){

        if($dolares>=$monto){

            $Nuevo_dolares = $dolares - $monto;
            $Nuevo_dolaresB = $dolaresB + $monto;
    
            // Actualizar patrimonio nuestro (pesos-monto)
    
            $user_check_query = "UPDATE users
            SET `dolares` = $Nuevo_dolares
            WHERE `id` = $id
            ";
    
            $result = mysqli_query($db, $user_check_query);
    
            // Actualizar el patrimonio del otro (pesosb + monto)
    
            $user_check_query = "UPDATE users
            SET `dolares` = $Nuevo_dolaresB
            WHERE `id` = $idB
            ";
    
            $result = mysqli_query($db, $user_check_query);
    
            // insertar transaccion a la otra planilla
    
            $user_check_query = "INSERT INTO `transacciones`(`pagador`, `recibidor`, `pesos`, `dolares`, `fecha`) VALUES ('$user' , '$userB' , 0 , $monto , $fecha)";
            $result = mysqli_query($db, $user_check_query);
    
    
            $user_check_query = "SELECT id FROM `transacciones` WHERE `fecha`=$fecha";
            $result = mysqli_query($db, $user_check_query);
    
            while($row = mysqli_fetch_array($result)) {
                $idTransaccion = $row['id']; 
            }
    
            $user_check_query = "SELECT `username`, `email` FROM `users` WHERE id=$idB";
            $result = mysqli_query($db, $user_check_query);
    
            while($row = mysqli_fetch_array($result)) {
                $userB = $row['username']; 
                $emailB = $row['email']; 
            }
    
    
    
            $url = "comprobante.php?monto=$monto&recibidor=$userB&mail=$emailB&id=$idTransaccion&moneda=$moneda";
            header("Location: $url ");               
    
        }else{
            $error="No hay fondos suficientes";
        }

    }else{
        $error="Seleccione moneda";
    }




}elseif($monto!=0){
    $error="El monto deben ser solo numeros";
}elseif($monto!=""){
    $error="Eliga el monto";
}

}elseif($userB!=""){
        $error="Ese usuario no existe!";
    }




    return $error;

}



?>
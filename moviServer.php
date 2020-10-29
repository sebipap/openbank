<?php 

include('db.php');
include('actualizar.php');



$user_check_query = " SELECT * FROM `transacciones` WHERE pagador='$username' or recibidor='$username'";
$result = mysqli_query($db, $user_check_query);


$transferencia = array();

while($row = mysqli_fetch_array($result)) {

    $pagador =  $row['pagador'];
    $recibidor =  $row['recibidor'];
    $pesos =  $row['pesos'];
    $dolares =  $row['dolares'];
    $fecha =  $row['fecha'];

    $fecha = date_create("$fecha");
    $fecha = date_format($fecha, "d/m H:i");

    if($pesos==0){
        $moneda="USD";
        $monto = $dolares;
    }

    if($dolares==0){
        $moneda="ARS";
        $monto = $pesos;
    }


    if(strcasecmp($pagador, $username)){$tipo="recibo";}
    if(strcasecmp($recibidor, $username)){$tipo="envio";}

    $frecuentes = array();

    if($tipo=="envio"){
        $frecuentes[] = "vahewiuhfuie ";
        $transferencia[] = "
        <tr>

            <td style='text-align: left; font-weight: 500';>
                Pagaste a $recibidor
                <h3>$fecha</h3>
            </td>

            <td style='text-align: right'>
                - $moneda $monto 
            </td>
 
        </tr>

        ";
    }elseif($tipo=="recibo"){
        $transferencia[] = "
        <tr>

            <td style='text-align: left; font-weight: 500;'>
                Recibiste de $pagador 
                <h3>$fecha</h3>
            </td>

            <td style='text-align: right'>
                + $moneda $monto 
            </td>

        </tr>

        ";
    }

}


array_reverse($transferencia);

?>

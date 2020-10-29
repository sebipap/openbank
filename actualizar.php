<?php
session_start();

$username = $_SESSION['username'];

if($username=="" or !isset($username)){
    header('Location: index.php');
}

include('db.php');
$user_check_query = "SELECT username, pesos, dolares, password, email, id FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($db, $user_check_query);

while($row = mysqli_fetch_array($result)) {
    $pesos = $row['pesos']; 
    $dolares = $row['dolares']; 
    $password = $row['password']; 
    $email = $row['email']; 
    $id = $row['id']; 


}
?>
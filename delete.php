<?php 
require "connection.php";
    
    $idd = $_GET['del'];
    $Delete = $pdo->prepare("DELETE FROM cart_temporary WHERE cart_id = :cartid");
    $Delete->bindParam(':cartid', $idd);
    $Delete->execute();

    if($Delete){
        header('Location: cart.php');
    }else{
        header('Location: cart.php?error');
    }
    
<?php
session_start();
    $sum=0;
    if (isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
        for ($i=0;$i<count($_SESSION['cart']);$i++){
            $sum+=$_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['count_current'];
        }
    }
    exit(json_encode($sum))
?>
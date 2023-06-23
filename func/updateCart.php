<?php
session_start();
if (isset($_GET['id']) && isset($_GET['count'])){
    $id=$_GET['id'];
    $count = $_GET['count'];
    // exit(json_encode($count));
    for ($i=0;$i<count($_SESSION['cart']);$i++){
        if ($id==$_SESSION['cart'][$i]['id']) {
            $_SESSION['cart'][$i]['count_current']=$count;break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    
}
exit(json_encode('OK'));

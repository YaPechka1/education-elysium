<?php
session_start();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    for ($i=0;$i<count($_SESSION['cart']);$i++){
        if ($id==$_SESSION['cart'][$i]['id']) {unset($_SESSION['cart'][$i]);break;}
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    
}
exit(json_encode('OK'));

?>
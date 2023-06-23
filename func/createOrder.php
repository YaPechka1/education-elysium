<?php 
    session_start();
    if (isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
        include './link.php';
        $query = "INSERT INTO `order`( `id_user`, `date`) VALUES (".$_SESSION['id'].",NOW())";
        mysqli_query($link,$query);
        $query = "SELECT LAST_INSERT_ID() as 'id';";
        $id=mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)[0]['id'];
        for ($i=0;$i<count($_SESSION['cart']);$i++){
            $query = "INSERT INTO `order_item`( `id_order`, `id_item`, `status`, `price`, `count`) VALUES ($id,".$_SESSION['cart'][$i]['id'].",0,".$_SESSION['cart'][$i]['price'].",".$_SESSION['cart'][$i]['count_current'].")";
            // exit(json_encode($query));
            mysqli_query($link,$query);
            $query="UPDATE `items` SET `count` = `count` - ".$_SESSION['cart'][$i]['count_current']." WHERE `items`.`id` = ".$_SESSION['cart'][$i]['id'];
            mysqli_query($link,$query);
        }
        $_SESSION['cart']=array();
    }
    exit(json_encode('OK'));
?>
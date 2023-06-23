<?php 
session_start();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $id_user = 0;
    $id_role=0;
    if (isset($_SESSION['id'])) $id_user = $_SESSION['id'];
    if (isset($_SESSION['id_role'])) $id_role = $_SESSION['id_role'];
    $query="SELECT (select count(*) FROM `items` INNER JOIN `category` on `category`.`id`=`items`.`id_category` INNER JOIN `shops` on `shops`.id = `category`.`id_shop` where `items`.id=$id and shops.id_user=$id_user) as 'admin', $id_role as 'id_role', `items`.`id`, `items`.`name`, `price`, `id_category`, `items`.`logo`, `count`, `category`.`name` as 'cat_name', `shops`.`name` as 'shop_name', `shops`.`id` as 'id_shop', `floor` FROM `items` INNER JOIN `category` on `category`.`id`=`items`.`id_category` INNER JOIN `shops` on `shops`.id = `category`.`id_shop` where `items`.id=$id";
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)[0]));
}
exit(json_encode(''));
?>
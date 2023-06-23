<?php 
session_start();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="SELECT `items`.`id`, `items`.`name`, `price`, `id_category`, `logo`, `count`, `category`.`name` as 'cat_name' FROM `items` INNER JOIN `category` on `category`.`id` = `items`.`id_category` WHERE `id_shop`=$id";
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)));
}
exit(json_encode(''));
?>
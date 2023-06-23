<?php 
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="SELECT `id`, `name` FROM `category` WHERE `id_shop`=$id";
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)));
}
exit(json_encode(''));
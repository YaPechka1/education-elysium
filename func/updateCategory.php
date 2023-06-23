<?php

if (isset($_GET['id']) && isset($_GET['name'])){
    $id=$_GET['id'];
    $name = $_GET['name'];
    include './link.php';
    $query="UPDATE `category` SET `name` = '$name' WHERE `category`.`id` = $id;";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));
?>
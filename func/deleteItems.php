<?php 
session_start();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="DELETE FROM `items` WHERE `items`.`id` = $id";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));
?>
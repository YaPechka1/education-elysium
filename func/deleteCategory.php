<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="DELETE FROM `category` WHERE `category`.`id` = $id";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));

?>
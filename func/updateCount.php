<?php

if (isset($_GET['id']) && isset($_GET['count'])){
    $id=$_GET['id'];
    $count = $_GET['count'];
    include './link.php';
    $query="UPDATE `floor` SET `count` = '$count' WHERE `floor`.`floor` = $id;";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));
?>
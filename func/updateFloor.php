<?php
if (isset($_GET['id']) && isset($_GET['floor'])){
    $id=$_GET['id'];
    $floor = $_GET['floor'];
    include './link.php';
    $query="UPDATE `floor` SET `floor` = '$floor' WHERE `floor`.`floor` = $id;";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));
?>
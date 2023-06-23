<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="DELETE FROM `floor` WHERE `floor`.`floor` = $id;";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));

?>
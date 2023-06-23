<?php
// exit(json_encode('OK'));

// exit(json_encode('OK'));

if (isset($_GET['id']) && isset($_GET['status'])){
    $id=$_GET['id'];
    $status=$_GET['status'];

    include './link.php';
    $query="UPDATE `order_item` SET `status` = '$status' WHERE `order_item`.`id` = $id;";
    mysqli_query($link,$query);
    // exit(json_encode($query));
}
exit(json_encode('OK'));

?>

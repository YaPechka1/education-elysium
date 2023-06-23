<?php
session_start();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $id_user = $_SESSION['id'];
    if (empty($_SESSION['id'])) $id_user=0;
    include './link.php';
    $query="select (SELECT count(*) from `shops` where id_user=$id_user and id=$id) as 'admin', `name`, `floor`, `logo` FROM shops WHERE id=$id";
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)[0]));
}
exit(json_encode(''));

?>
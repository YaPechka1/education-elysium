<?php 
session_start();
if (isset($_SESSION['id'])){
    include './link.php';
    $query = "SELECT `id`, `id_user`, DATE_FORMAT(`date`, '%d.%m.%Y') as 'date' FROM `order` WHERE id_user=".$_SESSION['id'];
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query), MYSQLI_ASSOC)));
}
exit(json_encode(''));
?>
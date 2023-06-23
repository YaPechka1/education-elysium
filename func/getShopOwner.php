<?php 
session_start();
include './link.php';
$query = "SELECT `id`,`name`, `floor`, `logo` FROM `shops` where `id_user`=".$_SESSION['id'];
exit(json_encode(mysqli_fetch_all(mysqli_query($link, $query), MYSQLI_ASSOC)));

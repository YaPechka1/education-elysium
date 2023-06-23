<?php 
include './link.php';
$query = "SELECT `id`,`name`, `floor`, `logo` FROM `shops`";
exit(json_encode(mysqli_fetch_all(mysqli_query($link, $query), MYSQLI_ASSOC)));

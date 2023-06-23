<?php
include './link.php';
$query="SELECT `floor`, `count` FROM `floor`";
exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)));
?>
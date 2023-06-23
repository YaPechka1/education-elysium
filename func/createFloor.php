<?php
include './link.php';
$query="INSERT INTO floor (count) VALUES (0);";
mysqli_query($link,$query);
$query="set @id = (select MAX(floor)+1 from floor where floor<>LAST_INSERT_ID());";
mysqli_query($link,$query);
$query=" UPDATE `floor` set `floor`.`floor`=@id where floor=LAST_INSERT_ID();";
mysqli_query($link,$query);
exit(json_encode('OK'));
?>
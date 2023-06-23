
<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="INSERT INTO `category` (`id`, `id_shop`, `name`) VALUES (NULL, '$id', 'Новая категория');";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));
?>
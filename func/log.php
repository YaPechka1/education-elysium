<?php
session_start();
$message='Нет данных';
if (empty($_POST['login']) || empty($_POST['password']))  exit(json_encode($message));
else{
    include './link.php';
    $query="SELECT `id`,`name`,`email`,`id_role` FROM `users` WHERE `login`= '".$_POST['login']."' and `password` = '".md5($_POST['password'])."'";
    $result = mysqli_query($link,$query);
    $count = mysqli_num_rows($result);
    if ($count==0){
        $message='Неверный логин или пароль';
        exit(json_encode($message));
    }
    else{

        $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
        foreach ($rows as $row){
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id_role'] = $row['id_role'];
            $_SESSION['cart'] = array();
        }
        $message='';

        exit(json_encode($message));
    }
}
?>
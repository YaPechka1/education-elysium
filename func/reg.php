<?php
    $message = '';
    if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['id_role'])){
        $message = 'Нет данных';
        exit(json_encode($message));
    }
    else{
        include './link.php';
        $query_login= " SELECT * FROM `users` where `login`= '".$_POST['login']."'";
        $result_login = mysqli_query($link,$query_login);
        $count = mysqli_num_rows($result_login);
        if ($count >0){
            $message = 'Данный логин занят';
            exit(json_encode($message));
        } 
        else{
        
        $query ="INSERT INTO `users`(`id`, `login`, `password`, `name`, `email`, `id_role`) VALUES (NULL,'".$_POST['login']."',MD5('".$_POST['password']."'),'".$_POST['name']."','".$_POST['email']."','".$_POST['id_role']."');";
        $result = mysqli_query($link,$query);
        $message='';
        exit(json_encode($message));
        }
    }
?>
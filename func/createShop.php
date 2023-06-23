<?php
    session_start();
    $message = '';
    if (empty($_FILES['logo']) || empty($_POST['name']) || empty($_POST['floor'])){
        $message = 'Нет данных';
        exit(json_encode($message));
    }
    else{

        $file = $_FILES['logo'];
        //переменная где хранится фото
        $name = $file['name'];//получить имя переменной
        $pathfile = __DIR__ . '\..\media\img\\' . $name;//полный путь до фото ДЛЯ сохранения на ПЗУ
        $pathfilee =  '/media/img/' . $name;//относительный путь файла для хранения в БД
        
        if (!move_uploaded_file($file['tmp_name'], $pathfile)) {
            $message='Ошибка передачи файла';
            exit(json_encode($message));
        }

        include './link.php';
        $query= "INSERT INTO `shops`(`id_user`, `name`, `floor`, `logo`) VALUES (".$_SESSION['id'].",'".$_POST['name']."','".$_POST['floor']."','$pathfilee')";
        mysqli_query($link,$query);
        $query="UPDATE `floor` SET `count` = `count`-1 WHERE `floor`.`floor` = ".$_POST['floor'];
        mysqli_query($link,$query);
        $message='';
        exit(json_encode($message));
        
    }

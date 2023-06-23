<?php
    session_start();
    $message = '';
    if (empty($_FILES['logo']) || empty($_POST['name']) || empty($_POST['cat']) || empty($_POST['price']) || empty($_POST['count'])){
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
        $query= "INSERT INTO `items`(`name`, `price`, `id_category`, `logo`, `count`) VALUES ('".$_POST['name']."','".$_POST['price']."','".$_POST['cat']."','$pathfilee','".$_POST['count']."')";
        mysqli_query($link,$query);
        $message='';
        exit(json_encode($message));
        
    }

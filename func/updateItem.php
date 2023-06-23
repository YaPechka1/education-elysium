<?php 

if (isset($_GET['id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['cat']) && isset($_POST['logoR']) && isset($_POST['count'])){
    $id=$_GET['id'];
    $pathfilee = $_POST['logoR'];
    if (isset($_FILES['logo'])){
        $file = $_FILES['logo'];
        //переменная где хранится фото
        $name = $file['name'];//получить имя переменной
        $pathfile = __DIR__ . '\..\media\img\\' . $name;//полный путь до фото ДЛЯ сохранения на ПЗУ
        $pathfilee =  '/media/img/' . $name;//относительный путь файла для хранения в БД
        
        if (!move_uploaded_file($file['tmp_name'], $pathfile)) {
            $message='Ошибка передачи файла';
            exit(json_encode($message));
        }
    }
    include './link.php';
    $query="UPDATE `items` SET `name`='".$_POST['name']."',`price`='".$_POST['price']."',`id_category`='".$_POST['cat']."',`logo`='".$pathfilee."',`count`='".$_POST['count']."' where  `id`=$id";
    mysqli_query($link,$query);
}
exit(json_encode('OK'));
?>
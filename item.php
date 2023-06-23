<?php
session_start();
if (empty($_GET['id'])) header('Location:/log.php');
// if ($_SESSION['id_role'] == '1') header('Location:/hub.php');
// if ($_SESSION['id_role'] == '3') header('Location:/admin.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="stylesheet" href="./style/owner.css">
    <link rel="stylesheet" href="./style/item.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Elysium</title>
</head>

<body>
    <?php
    require './header.php'
    ?>
    <main>
        <section class="container hor">
            <img class="block" src="" alt="">
            <div class="block">
                <form name="item" class="grid22" onsubmit="return false">
                    <span>Название товара:</span>
                    <input type="text" name="name" class="block">
                    <?php
                    if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == '1') {
                        $count =1;
                        for ($i=0;$i<count($_SESSION['cart']);$i++){
                            if ($_GET['id']==$_SESSION['cart'][$i]['id']){
                                $count = $_SESSION['cart'][$i]['count_current'];
                                break;
                            }
                        }
                        echo '<span>Количество текущее:</span>
                        <input type="number" name="count_current" min="1" value="'.$count.'" class="block">';
                    }
                    ?>
                    <span>Количество на складе:</span>
                    <input type="number" name="count" min="0" class="block">
                    <span>Цена товара:</span>
                    <input type="number" name="price" class="block">
                    <span class="logoText">Фото:</span>
                    <input type="file" name="logo" class="block">
                    <span>Магазин:</span>
                    <input type="text" name="shop" readonly class="block">
                    <span>Этаж:</span>
                    <input type="text" name="floor" readonly class="block">
                    <span>Категория товара:</span>
                    <select name="cat" class="block"></select>
                    <button class="btn edit" onclick="updateItem()">Изменить</button>
                    <?php
                    if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == '1')
                        echo '<button class="btn buy" onclick="Buy()">Купить</button>'
                    ?>
                </form>
            </div>
        </section>
    </main>
    <?php
    require './footer.php';
    ?>
    <script src="./script/main.js"></script>
    <script src="./script/items.js"></script>
</body>

</html>
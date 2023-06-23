<?php
session_start();
if (empty($_GET['id'])) header('Location:/shops.php');
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
    <link rel="stylesheet" href="./style/one-shop.css">
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
        <section class="container hor data">

        </section>
        <section class="container grid44 it">
            <div class="block grid22 cat hide">
                <h4>Категории товаров</h4>
            </div>
            <div class="block hide">
                <form name="items" onsubmit="return false">
                    <h4>Добавить товар</h4>
                    <input type="text" class="block" name="name" placeholder="Название:">
                    <input type="file" class="block" name="logo">
                    <input type="number" name="count" class="block" placeholder="Количество товара:">
                    <input type="number" name="price" class="block" placeholder="Цена товара:">
                    <select class="block" name="cat">
                    </select>
                    <button class="btn" onclick="submitForm()">Добавить</button>
                    <span class="hide total"></span>
                </form>
            </div>

        </section>
    </main>
    <?php
    require './footer.php';
    ?>
    <script src="./script/main.js"></script>
    <script src="./script/one-shop.js"></script>
</body>

</html>
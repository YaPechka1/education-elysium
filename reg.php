<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/main.css">
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
        <div class="container">
            <div class="block">
                <form name="reg" onsubmit="return false">
                    <h2>Регистрация</h2>
                    <input type="text" class="block" name="name" placeholder="Ваше имя:">
                    <input type="text" class="block" name="email" placeholder="Ваша почта:">
                    <select class="block" name="id_role" id="">
                        <option value="1">Я посетитель</option>
                        <option value="2">Я арендатор</option>
                    </select>
                    <input type="text" class="block" name="login" placeholder="Логин:">
                    <input type="password" class="block" name="password" placeholder="Пароль:">
                    <button class="btn" onclick="submitForm()">Регистрация</button>
                    <span class="hide total"></span>
                </form>
            </div>
        </div>
    </main>
    <?php 
        require './footer.php';
    ?>
    <script src="./script/main.js"></script>
    <script src="./script/reg.js"></script>
</body>

</html>
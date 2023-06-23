<header>
    <div class="logo"> <!-- логотип -->
        <a href="/index.php">
            <img src="./media/logo.png" alt="logo">
            <span>Elysium</span>
        </a>
    </div>
    <nav> <!-- блок навигации -->
        <ul>
            <li><a href="/">О нас</a></li>
            <li><a href="/shops.php">Наши магазины</a></li>
            <?php
            if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 1) echo '<li><a href="/hub.php">Мои заказы</a></li>';
            if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 1) echo '<li><a href="/cart.php">Корзина</a></li>';
            if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 2) echo '<li><a href="/owner.php">Мои магазины</a></li>';
            if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3) echo '<li><a href="/admin.php">Администрирование</a></li>';
            ?>


        </ul>
    </nav>
    <div class="account"> <!-- кнопка входа -->
        <?php
        if (empty($_SESSION['id'])) echo '<a href="./log.php"><button class="btn">Login</button></a>';
        else {
            echo '<a href="./func/exit.php"><button class="btn">Logout</button></a>';
        }
        ?>

    </div>
    <div class="toggle-menu hide"> <!-- кнопка для открытия/закрытия навигации на мобильных устройствах -->
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>
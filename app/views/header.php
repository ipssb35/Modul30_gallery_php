<?php
    session_start();
?>

<header class="header">
    <div class="header__wrapper">
        
        <nav class="nav">
            <div class="nav__logo">
                <a href="/">Галерея</a>
            </div>

            <div class="nav__menu">
            
                <ul>
                    <?php if (!isset($_SESSION['login'])): ?>
                        <li><a href="/login">Войти</a></li>
                        <li><a href="/register">Регистрация</a></li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['login'])): ?>
                        <li><a href="/logout">Выйти</a></li>
                    <?php endif; ?>
                </ul>
            
            </div>
        </nav>

    </div>
</header>
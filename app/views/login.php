<?php

    session_start();
    if (isset($_SESSION['login'])) header('Location:/');

?>

<main class="main">
    <div class="main__wrapper">

        <div class="errors"></div>

        <form action="" method="POST" class="form" id="loginForm">
            <input type="text" name="authLogin" class="text" placeholder="login" id="authLogin" />
            <input type="password" name="authPassword" class="text" placeholder="password" id="authPassword" />
            <input type="submit" class="submit" value="Войти" id="authSubmit" />
        </form>

    </div>
</main>

<script src="../js/auth.js"></script>
<?php

    session_start();
    if (isset($_SESSION['login'])) header('Location:/');

?>

<main class="main">
    <div class="main__wrapper">

        <div class="errors"></div>
        
        <form action="" method="POST" class="form" id="registerForm">
            <input type="text" name="registerLogin" class="text" placeholder="login" id="registerLogin" />
            <input type="password" name="registerPassword" class="text" placeholder="password" id="registerPassword" />
            <input type="password" name="registerConfirmPassword" class="text" placeholder="confirm password" id="registerConfirmPassword" />
            <input type="submit" class="submit" value="Зарегистрироваться" id="registerSubmit" />
        </form>

    </div>
</main>

<script src="../js/register.js"></script>
<?php

    session_start();
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /* данные с полей формы */
        $login = htmlspecialchars(trim($_POST['authLogin']));
        $password = htmlspecialchars(trim($_POST['authPassword']));

        /* проверка на пустые поля */
        if (empty($login) || empty($password)) {
            echo 'did not enter login and/or password';
            return;
        }

        /* поиск пользователя в базе */
        $sql = 'SELECT * FROM users WHERE login=:login AND password=:password';
        $result = $pdo->prepare($sql);
        $result->bindValue(':login', $login);
        $result->bindValue(':password', md5($password));
        $result->execute();
        $result = $result->fetch(PDO::FETCH_OBJ);

        if (!$result) {
            echo 'login and/or the password was entered incorrectly';
            return;
        }

        /* запись в сессии */
        $_SESSION['login'] = $result->login;
        $_SESSION['id'] = $result->id;

        echo 'redirect';
    }
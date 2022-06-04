<?php

    session_start();
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /* данные с полей формы */
        $login = htmlspecialchars(trim($_POST['registerLogin']));
        $password = htmlspecialchars(trim($_POST['registerPassword']));
        $confirmPassword = htmlspecialchars(trim($_POST['registerConfirmPassword']));

        /* проверка на корректность ввода */
        if (empty($login) || empty($password) || empty($confirmPassword)) {
            echo 'did not enter login and/or password';
            return;
        }

        if (strlen($login) < 3) {
            echo 'login must be at least 3 characters';
            return;
        }

        if (strlen($password) < 6) {
            echo 'password must be at least 6 characters';
            return;
        }

        if (!preg_match('/^([a-zA-Z\d])+$/', $login)) {
            echo 'login contains invalid characters (a-z, A-Z, 0-9)';
            return;
        }

        if (!preg_match('/^([a-zA-Z\d])+$/', $password)) {
            echo 'password contains invalid characters (a-z, A-Z, 0-9)';
            return;
        }

        if ($password !== $confirmPassword) {
            echo 'password mismatch';
            return;
        }

        /* поиск имеющегося логина в базе */
        $sql = 'SELECT login FROM users WHERE login=:login';
        $result = $pdo->prepare($sql);
        $result->bindValue(':login', $login);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_OBJ);

        if ($result) {
            echo 'such user already exists';
            return;
        }

        /* добавление нового пользователя */
        $sql = 'INSERT INTO users (id, login, password) VALUES (null, :login, :password)';
        $result = $pdo->prepare($sql);
        $result->bindValue(':login', $login);
        $result->bindValue(':password', md5($password));
        $result->execute();

        echo 'redirect';
    }
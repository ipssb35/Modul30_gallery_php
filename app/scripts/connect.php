<?php

    $host = 'localhost';
    $db = 'gallery';
    $user = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:dbname=$db;host=$host", $user, $password);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        echo 'Unable to connect to database server';
        exit();
    }
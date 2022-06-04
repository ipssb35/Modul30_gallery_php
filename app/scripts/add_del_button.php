<?php

    session_start();
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['login'])) {
            $sql = 'SELECT * FROM images WHERE id="' . $_POST['hiddenId'] . '" and user_id="' . $_SESSION['id'] . '" LIMIT 1';
            $result = $pdo->prepare($sql);
            $result->execute();
            $result = $result->fetchAll();

            echo json_encode($result);
        } else echo json_encode('');
    }
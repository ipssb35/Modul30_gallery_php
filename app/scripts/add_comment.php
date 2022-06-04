<?php

    session_start();
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /* данные с поля формы */
        $comment = htmlspecialchars(trim($_POST['comment']));
        $created_at = date('d.m.Y');
        $images_id = htmlspecialchars(trim($_POST['hiddenId']));

        if (!$comment) $comment = '';

        if ($comment !== '') {
            $sql = 'INSERT INTO comments (id, text, created_at, user_id, images_id)
                VALUES (null, :text, :created_at, :user_id, :images_id)';
            $result = $pdo->prepare($sql);
            $result->bindValue(':text', $comment);
            $result->bindValue(':created_at', $created_at);
            $result->bindValue(':user_id', $_SESSION['id']);
            $result->bindValue(':images_id', $images_id);
            $result->execute();
            $commentId = $pdo->lastInsertId();
        }

        $result = [$_SESSION['login'], $comment, $created_at, $commentId];

        echo json_encode($result);
    }
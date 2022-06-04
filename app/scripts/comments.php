<?php

    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = '
            select 
                i.id, login, text, created_at 
            from 
                comments c 
                join images i on c.images_id = i.id 
                join users u on c.user_id = u.id 
            where i.id = "' . $_POST['hiddenId'] . '"
        ';
        $result = $pdo->prepare($sql);
        $result->execute();
        $commentId = $pdo->lastInsertId();
        $result = $result->fetchAll();

        echo json_encode($result);
    }
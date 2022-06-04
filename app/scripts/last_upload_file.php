<?php

    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = 'SELECT file FROM images WHERE id="' . $_POST['lastId'] . '"';
        $result = $pdo->prepare($sql);
        $result->execute();
        $result = $result->fetch();

        echo $result['file'];
    }
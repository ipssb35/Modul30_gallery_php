<?php

    session_start();
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = 'SELECT file FROM images WHERE id="' . $_POST['hiddenId'] . '" LIMIT 1';
        $result = $pdo->prepare($sql);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_OBJ);
        $file = '../../uploads/' . $result->file;

        $sql = 'DELETE FROM images WHERE id="' . $_POST['hiddenId'] . '"';
        $result = $pdo->prepare($sql);
        $result->execute();

        if (file_exists($file)) unlink($file);
        echo 'photo deleted successfully';
    }
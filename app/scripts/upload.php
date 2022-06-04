<?php

    session_start();
    include '../core/config.php';
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_FILES)) return;

        /* перебор массива изображений */
        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $fileName = $_FILES['files']['name'][$i];

            /* проверка на допустимый размер */
            if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
                echo 'file size is too large: ' . $_FILES['files']['name'][$i] . '<br/>';
                continue;
            }

            /* проверка на допустимый формат файла */
            if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
                echo 'invalid file format: ' . $_FILES['files']['name'][$i] . '<br/>';
                continue;
            }

            /* перенос файла в папку uploads */
            $filePath = UPLOAD_DIR . '/' . basename($fileName);

            if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], '../../' . $filePath)) {
                echo 'file upload error: ' . $_FILES['files']['name'][$i] . '<br/>';
                continue;
            }

            /* переименуем файл во избежание конфликта имен */
            $extension = explode('.', $_FILES['files']['name'][$i]);
            $newFileName = microtime(true) . '.' . end($extension);
            rename('../../' . $filePath, '../../' . UPLOAD_DIR . '/' . $newFileName);

            /* запись файла в бд */
            $sql = 'INSERT INTO images (id, file, user_id) VALUES(null, :file, :userId)';
            $result = $pdo->prepare($sql);
            $result->bindValue(':file', $newFileName);
            $result->bindValue('userId', $_SESSION['id']);
            $result->execute();
        }
    }
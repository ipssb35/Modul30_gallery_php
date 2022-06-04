<?php

    class Model_Welcome extends Model
    {
        public function getImages() {
            include 'app/scripts/connect.php';

            $sql = 'SELECT * FROM images';
            $result = $pdo->prepare($sql);
            $result->execute();
            $result = $result->fetchAll();

            return $result;
        }
    }
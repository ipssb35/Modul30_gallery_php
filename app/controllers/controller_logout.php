<?php

    class Controller_logout extends Controller
    {
        public function index()
        {
            session_start();
            session_destroy();

            header('Location: /');
        }
    }
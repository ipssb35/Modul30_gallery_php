<?php

    class Controller_Register extends Controller
    {
        public function index() {
            $data['title'] = 'register';
            $this->view->generate('register.php', 'template.php', $data);
        }
    }
<?php

    Class Controller_Login extends Controller
    {
        public function index() {
            $data['title'] = 'login';
            $this->view->generate('login.php', 'template.php', $data);
        }
    }
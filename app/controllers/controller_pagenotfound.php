<?php

    class Controller_Pagenotfound extends Controller
    {
        public function index()
        {
            $data['title'] = '404';
            $this->view->generate('pagenotfound.php', 'template.php');
        }
    }
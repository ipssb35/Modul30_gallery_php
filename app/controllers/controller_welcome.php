<?php

    class Controller_Welcome extends Controller
    {
        public function __construct()
        {
            $this->model = new Model_Welcome();
            $this->view = new View();
        }

        public function index() {
            $data['title'] = 'gallery';
            $data['images'] = $this->model->getImages();
            $this->view->generate('welcome.php', 'template.php', $data);
        }
    }
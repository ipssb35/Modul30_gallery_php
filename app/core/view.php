<?php

    class View
    {
        public function generate($content, $template, $data = null) {
            include 'app/views/' . $template;
        }
    }
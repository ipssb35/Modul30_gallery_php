<?php

    class Route
    {
        public static function start() {
            // контроллер и действие по умолчанию
            $controllerName = 'welcome';
            $actionName = 'index';
            $routes = $_GET['url'];

            // получаем имя контроллера
            if (!empty($routes)) $controllerName = $routes;

            // подцепляем файл с классом модели
            $modelName = 'model_' . $controllerName;
            $controllerName = 'controller_' . $controllerName;

            $modelFile = 'app/models/' . strtolower($modelName) . '.php';

            if (file_exists($modelFile)) include $modelFile;

            // создаем контроллер
            $controllerFile = 'app/controllers/' . strtolower($controllerName) . '.php';

            if (file_exists($controllerFile)) include $controllerFile;
            else Route::ErrorPage404();

            // создаем контроллер
            $controller = new $controllerName;
            $action = $actionName;
            
            if (method_exists($controller, $action)) $controller->$action();
            else Route::ErrorPage404();
        }

        public static function ErrorPage404() {
            header('Location:/pagenotfound');
        }
    }
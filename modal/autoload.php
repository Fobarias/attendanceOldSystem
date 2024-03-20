<?php
    spl_autoload_register('loadModel');
    spl_autoload_register('loadController');
    spl_autoload_register('loadView');

    function loadModel($model) {
        $extension = '.php';

        $pathModel      = 'modal/';
        $fullPathModel  = $pathModel . $model . $extension;

        if (!file_exists($fullPathModel)) {
            return false;
        }

        include_once $fullPathModel;
    }

    function loadController($controller) {
        $extension = '.php';

        $pathController      = 'controller/';
        $fullPathController  = $pathController . $controller . $extension;

        if (!file_exists($fullPathController)) {
            return false;
        }

        include_once $fullPathController;
    }

    function loadView($view) {
        $extension = '.php';

        $pathView      = 'view/';
        $fullPathView  = $pathView . $view . $extension;

        if (!file_exists($fullPathView)) {
            return false;
        }

        include_once $fullPathView;
    }
?>
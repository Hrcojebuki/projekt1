<?php
    session_start();

    require_once 'app/config/config.php';
    require_once 'app/config/Autoloader.php';

    $controller = new Controller();
    $controller->handle_request();
?>
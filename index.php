<?php
    use app\models\Model;
    use core\Router;
    use core\Request;

    require_once(__DIR__ .'/core/Router.php');
    require_once(__DIR__ . '/core/Request.php');


    $router = new Router();

    $request = new Request();

    require_once(__DIR__ . '/routes/web.php');

    try {
        $router->dispatch($request);
    } catch (Exception $e) {
        echo($e->getMessage());
    }



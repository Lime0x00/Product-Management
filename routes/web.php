<?php
    use core\Router;
    use app\controllers\UserController;
    use app\controllers\ErrorController;
    use app\controllers\ProductController;

    require_once(__DIR__ . './../core/Router.php');

    $router = new Router();

    // GET ROUTES
    $router->get('/dashboard',[UserController::class, 'dashboard']);
    $router->get('/login', [UserController::class, 'loginPage']);
    $router->get('/404', [ErrorController::class, 'notFound']);
    $router->get('/products', [ProductController::class, 'products']);
    $router->get('/register', [UserController::class, 'registerPage']);
    $router->get('/add-product', [ProductController::class, 'addProductForm']);
    $router->get('/show-products', [ProductController::class, 'showProducts']);
    $router->get('/edit-product', [ProductController::class, 'editProductForm']);


    // POST ROUTES
    $router->post('/login', [UserController::class, 'login']);
    $router->post('/register', [UserController::class, 'register']);
    $router->post('/add-product', [ProductController::class, 'addProduct']);
    $router->post('/logout', [UserController::class, 'logout']);
    $router->post('/delete-product', [ProductController::class, 'deleteProduct']);
    $router->post('/edit-product', [ProductController::class, 'editProduct']);

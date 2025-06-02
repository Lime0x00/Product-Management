<?php
    use core\Router;
    require_once(__DIR__ . '/../../../core/Router.php');
?>


<div class="text-center">
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <p class="fs-3"> <span class="text-danger">Oops!</span> Page not found.</p>
    <p class="lead">
        The page you’re looking for doesn’t exist.
    </p>
    <a href="<?=Router::url('dashboard')?>" class="btn btn-primary">Go Dashboard</a>
</div>


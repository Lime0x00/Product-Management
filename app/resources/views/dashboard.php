<?php
    require_once(__DIR__ . '/../../../core/Router.php');
    use core\Router;
?>

<main class="flex-grow-1 d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h1 class="mb-4">Welcome, <strong><?= htmlspecialchars(@$name) !== null ? $name : 'Guest' ?></strong>!</h1>
        <p class="lead">You have successfully logged in.</p>

        <!-- Logout Button -->
        <form method="POST" action="<?= Router::url('logout') ?>" class="mt-4">
            <button type="submit" class="btn btn-danger btn-lg">Logout</button>
        </form>
    </div>
</main>

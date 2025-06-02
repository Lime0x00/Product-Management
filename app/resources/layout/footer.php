<?php
    use core\Router;
    require_once(__DIR__ . '/../../../core/Router.php');
?>

<footer class="bg-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0 text-muted">&copy; <?= date('Y') ?> My Application. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="<?= Router::url('privacy') ?>" class="text-dark text-decoration-none">Privacy Policy</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?= Router::url('terms') ?>" class="text-dark text-decoration-none">Terms of Service</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?= Router::url('contact') ?>" class="text-dark text-decoration-none">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.9"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.13"></script>



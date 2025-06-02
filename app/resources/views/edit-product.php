<?php
    use core\Router;
    require_once(__DIR__ . '/../../../core/Router.php');
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-4">
                <h1 class="fs-4 card-title text-center mb-4">Edit Product</h1>

                <?php if (isset($msg)): ?>
                    <div class="alert
                        <?= @$statusCode === 200 ? 'alert-success' : ($statusCode === 400 ? 'alert-danger' : 'alert-warning') ?>
                        alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($msg) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= Router::url('edit-product') ?>">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Product Id</label>
                        <input id="productId" type="text" class="form-control" value="<?=@$id?>" disabled />
                        <input type="hidden" name="id" value="<?=@$id?>" />
                    </div>

                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input id="productName" type="text" class="form-control" name="name" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input id="productPrice" type="number" step="0.01" class="form-control" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="productStock" class="form-label">Description</label>
                        <input id="productStock" type="text" class="form-control" name="description" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Edit Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const waitTime = <?= $waitTime ?? 0 ?>;
    const redirectUrl = "<?= $redirectUrl ?? '/' ?>";

    if (waitTime > 0) {
        setTimeout(() => {
            window.location.href = redirectUrl;
        }, waitTime * 1000);
    }
</script>

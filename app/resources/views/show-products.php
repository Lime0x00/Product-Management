<?php
    use core\Router;
    use core\Session;
    require_once(__DIR__ . '/../../../core/Router.php');
    require_once(__DIR__ . '/../../../core/Session.php');

    $session = new Session();
    $flash = $session->get('flash');
    $session->set('flash', null);
?>
<div class="container mt-5">

    <?php if (!empty($flash['msg'])): ?>
        <div id="flashMsg" class="alert
            <?= $flash['statusCode'] === 200 ? 'alert-success' : 'alert-danger' ?>
            alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['msg']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            const flashMsg = document.getElementById("flashMsg");
            if (flashMsg) {
                flashMsg.classList.add("show");
                setTimeout(() => {
                    flashMsg.classList.remove("show");
                    flashMsg.classList.add("fade");
                }, 3000);
            }
        </script>
    <?php endif; ?>

    <h2 class="mb-4 text-center">Products List</h2>

    <div class="table-responsive shadow-sm p-3 bg-body rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= nl2br(htmlspecialchars($product['description'] ?? 'No description')) ?></td> <!-- ✅ NEW -->
                        <td>$<?= number_format($product['price'], 2) ?></td>
                        <td>
                            <a href="<?= Router::url('edit-product') . '?id=' . $product['id'] ?>"
                               class="btn btn-warning btn-sm me-1">
                                Edit
                            </a>

                            <form action="<?= Router::url('delete-product') ?>" method="POST" class="d-inline">
                                <input type="hidden" name="product-id" value="<?= $product['id'] ?>" />
                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No products found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

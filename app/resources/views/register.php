<div class="container d-flex justify-content-center align-items-center min-vh-50">
<div class="col-md-6 col-lg-4">
    <div class="card shadow-lg">
        <div class="card-body p-5">
            <h1 class="fs-4 card-title text-center mb-4">Register</h1>

            <?php if (isset($msg)): ?>
                <div class="alert
                    <?= @$statusCode === 200 ? 'alert-success' : ($statusCode === 400 ? 'alert-danger' : 'alert-warning') ?>
                    alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($msg) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus />
                </div>
                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input id="emailAddress" type="email" class="form-control" name="emailAddress" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Register
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

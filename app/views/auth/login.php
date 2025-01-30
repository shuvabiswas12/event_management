<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<?php if (isset($_SESSION["error"])): ?>
    <div class="alert alert-danger mx-3">
        <?php echo $_SESSION["error"];
        unset($_SESSION["error"]); ?>
    </div>
<?php endif; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 33%;">
        <h3 class="text-center mb-3">Login</h3>
        <form action="/event_management/auth/login" method="post" id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                <small class="text-danger" id="emailError"></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                <small class="text-danger" id="passwordError"></small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="text-center mt-2">Don't have an account? <a href="<?php echo ROOT . '/auth/register'; ?>">Register</a></p>
        </form>
    </div>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
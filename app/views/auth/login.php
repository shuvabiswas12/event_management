<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h3 class="text-center mb-3">Login</h3>
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter email">
                <small class="text-danger" id="emailError"></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter password">
                <small class="text-danger" id="passwordError"></small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="text-center mt-2">Don't have an account? <a href="<?php echo ROOT . '/auth/register'; ?>">Register</a></p>
        </form>
    </div>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>

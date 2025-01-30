<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h3 class="text-center mb-3">Register</h3>
        <form id="registerForm">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" class="form-control" placeholder="Enter full name">
                <small class="text-danger" id="nameError"></small>
            </div>
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
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control" placeholder="Re-enter password">
                <small class="text-danger" id="confirmPasswordError"></small>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
            <p class="text-center mt-2">Already have an account?  <a href="<?php echo ROOT . '/auth/login'; ?>">Login</a></p>

        </form>
    </div>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>

<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="error-container">
    <h1>404</h1>
    <p>Sorry, the page you're looking for can't be found.</p>
    <button onclick="goBack()" class="btn-back">Go Back to Home</button>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container mt-5">
    <!-- Display messages -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'];
                                        unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'];
                                            unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between">
        <button onclick="goBack()" class="btn btn-secondary mb-3">Go Back</button>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $event['user_id']): ?>
            <div style="width: 10%;">
                <a href="/event_management/events/edit/<?= $event['id'] ?>" class="btn btn-warning btn-md w-100">EDIT</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($event['name']) ?></h2>
            <p class="text-muted">Event Date: <?= date('F j, Y', strtotime($event['event_date'])) ?></p>
            <p class="card-text"><?= nl2br(htmlspecialchars($event['description'])) ?></p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <p class="pt-3">CREATED BY: <?= htmlspecialchars($event['user_name']) ?></p>
            <i class="pt-3"><?= htmlspecialchars($event['created_at']) ?></i>
        </div>
    </div>

    <p class="lead mt-3">Do you want to get <strong>Registration form</strong> for booking event? <a href='<?php echo ROOT . "/events/register" ?>' class="mx-2 btn btn-danger">GO Here</a></p>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
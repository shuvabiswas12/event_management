<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container my-5">
    <h2 class="mb-4">Event Dashboard</h2>

    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-body flex-grow-1">
                        <div class="h-75">
                            <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                            <p class="card-text">
                                <?= strlen($event['description']) > 100
                                    ? htmlspecialchars(substr($event['description'], 0, 100)) . "..."
                                    : htmlspecialchars($event['description']);
                                ?>
                            </p>
                        </div>

                        <div class="h-75 py-3">
                            <a href="<?= ROOT ?>/events/view/<?= $event['id'] ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center mt-3">
                        <strong>Date:</strong> <?= date('F j, Y', strtotime($event['event_date'])) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<!-- Hero Section -->
<header class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1>Welcome to the Event Management System</h1>
        <p>Discover and register for exciting events!</p>
        <a href="<?php echo ROOT; ?>/events" class="btn btn-light">Get Started</a>
    </div>
</header>

<!-- Event Listings -->
<section class="container my-5">
    <h2 class="text-center mb-4">Upcoming Events</h2>
    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                        <p class="card-text" style="height: 55px;">
                            <?= strlen($event['description']) > 100
                                ? htmlspecialchars(substr($event['description'], 0, 100)) . "..."
                                : htmlspecialchars($event['description']);
                            ?>
                        </p>
                        <a href="<?= ROOT ?>/events/view/<?= $event['id'] ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
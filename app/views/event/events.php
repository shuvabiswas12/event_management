<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container my-5">
    <h2 class="mb-4">📌 Available Events</h2>

    <form action="<?= ROOT ?>/events/search" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search events..." required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php if (isset($_GET['query'])): ?>
        <h3>Search Results for "<?= htmlspecialchars($_GET['query']) ?>"</h3>
    <?php else: ?>
        <h2 class="mb-4">Event Dashboard</h2>
    <?php endif; ?>


    <!-- Sorting Options -->
    <div class="mb-3">
        <label>Sort By:</label>
        <a href="?sort=name&order=asc" class="btn btn-sm btn-outline-primary">Name - ASC ↑</a>
        <a href="?sort=name&order=desc" class="btn btn-sm btn-outline-primary">Name - DESC ↓</a>
        <a href="?sort=event_date&order=asc" class="btn btn-sm btn-outline-primary">Event Date - ASC ↑</a>
        <a href="?sort=event_date&order=desc" class="btn btn-sm btn-outline-primary">Event Date - DESC ↓</a>
    </div>

    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                        <p class="card-text">
                            <?= strlen($event['description']) > 100
                                ? htmlspecialchars(substr($event['description'], 0, 100)) . "..."
                                : htmlspecialchars($event['description']);
                            ?>
                        </p>
                        <a href="<?= ROOT ?>/events/view/<?= $event['id'] ?>" class="btn btn-primary">View Details</a>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <strong>Date:</strong> <?= date('F j, Y', strtotime($event['event_date'])) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php
            // Ensure totalPages is set and at least 1
            $totalPages = isset($totalPages) ? max(1, (int)$totalPages) : 1;
            ?>
            <?php foreach (range(1, $totalPages) as $i): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&sort=<?= urlencode($sort) ?>&order=<?= urlencode($order) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
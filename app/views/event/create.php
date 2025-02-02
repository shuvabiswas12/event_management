<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container mt-5" style="height: 75vh;">
    <h2 class="mb-4">Create New Event</h2>

    <!-- Display error or success messages -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'];
                                        unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'];
                                            unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form action="<?= ROOT ?>/events/create" method="POST">
        <div class="d-flex justify-content-between">
            <div class="mb-3 w-100">
                <label for="name" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div style="width: 30px;"></div>
            <div class="mb-3 w-100">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" required>
            </div>
            <div style="width: 30px;"></div>
            <div class="mb-3 w-100">
                <label for="max_capacity" class="form-label">Total Capacity</label>
                <input type="number" class="form-control" id="max_capacity" name="max_capacity" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" rows="10" id="description" name="description" required></textarea>
        </div>



        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
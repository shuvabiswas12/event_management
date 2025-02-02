<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container mt-5" style="height: 77vh;">

    <h2 class="mb-4">Register for an Event</h2>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'];
                                            unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION["error"];
            unset($_SESSION["error"]); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($events)): ?>
        <form action="<?= ROOT ?>/events/register" method="POST" class="w-75 m-auto">
            <label for="event_id">Select an Event:</label>
            <select id="event_id" name="event_id" required class="form-select">
                <option value="">Select an event</option>
                <?php foreach ($events as $event) : ?>
                    <?php if ($_SESSION['user_id'] !== $event['user_id']): ?>
                        <option value="<?= $event['id']; ?>">
                            <div class="d-flex justify-content-between">
                                <p class="lead"><?= htmlspecialchars($event['name']); ?></p>
                                <p class="h4">Date: <?= htmlspecialchars($event['event_date']); ?></p>
                            </div>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <div class="d-flex justify-content-between my-4">
                <div class="w-100">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required class="form-control">
                </div>

                <div style="width: 30px;"></div>

                <div class="w-100">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger"">
            <p class=" text-center h4 mt-2">No events is available!</p>
        </div>
    <?php endif; ?>

</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
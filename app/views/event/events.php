<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container mt-5" style="height: 77vh;">
    <div class="d-flex justify-content-between my-3">
        <h2>Event List</h2>
        <a href='<?php echo ROOT . "/events/create" ?>' style="font-size: 18px;"><button class="btn btn-success">CREATE</button></a>
    </div>

    <?php if (isset($_SESSION["success"])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION["success"];
            unset($_SESSION["success"]); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["error"])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION["error"];
            unset($_SESSION["error"]); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered mb-3">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['id']) ?></td>
                        <td><?= htmlspecialchars($event['name']) ?></td>
                        <td><?= htmlspecialchars($event['description']) ?></td>
                        <td><?= htmlspecialchars($event['created_at']) ?></td>
                        <td>
                            <a href="/event_management/events/edit/<?= $event['id'] ?>" class="btn btn-warning btn-sm w-100">Edit</a>
                            <hr>
                            <a href="/event_management/events/delete/<?= $event['id'] ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No events found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
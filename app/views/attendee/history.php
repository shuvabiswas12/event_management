<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container mt-5">
    <h2 class="text-center">📜 Booking History</h2>

    <?php if (!$bookings): ?>
        <p class="text-center text-muted alert alert-danger mt-5">❌ No booking history found.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Registration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['event_name']) ?></td>
                        <td><?= date("F j, Y", strtotime($booking['event_date'])) ?></td>
                        <td><?= date("F j, Y, g:i A", strtotime($booking['registration_date'])) ?></td>
                        <td>
                            <a href="/event_management/attendees/details/<?= $booking['event_id'] ?>/<?= $booking['user_id'] ?>" class="btn btn-secondary btn-sm w-100 my-1">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
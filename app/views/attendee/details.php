<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

<div class="container mt-5">

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'];
                                            unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if ($result) : ?>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Attendee Registration Confirmation</h2>
                <hr>

                <p><strong>Name:</strong> <?= htmlspecialchars($result['attendee_name'] ?? 'N/A') ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($result['email'] ?? 'N/A') ?></p>
                <p><strong>Event:</strong> <?= htmlspecialchars($result['event_name'] ?? 'N/A') ?></p>
                <p><strong>Date:</strong> <?= date('F j, Y', strtotime($result['event_date'])) ?></p>
            </div>
        </div>
        <div class="text-center mt-3">
            <button onclick="window.print()" class="btn btn-primary">Print</button>
            <button onclick="downloadPDF()" class="btn btn-success">Download PDF</button>
        </div>
    <?php else : ?>
        <p class="text-danger text-center">No registration details found.</p>
    <?php endif; ?>
</div>

<script>
    function downloadPDF() {
        const element = document.querySelector(".card");

        html2pdf()
            .from(element)
            .save("Attendee_Details.pdf");
    }
</script>

<!-- Include the HTML2PDF Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


<?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>
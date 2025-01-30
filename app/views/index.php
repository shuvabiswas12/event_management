<?php include BASE_PATH . "/app/views/layouts/header.php"; ?>
<?php include BASE_PATH . "/app/views/layouts/navbar.php"; ?>

    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Welcome to the Event Management System</h1>
            <p>Discover and register for exciting events!</p>
            <a href="/auth/register" class="btn btn-light">Get Started</a>
        </div>
    </header>
    
    <!-- Event Listings -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Upcoming Events</h2>
        <div class="row">
            <!-- Sample Event Card -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="event-image.jpg" class="card-img-top" alt="Event">
                    <div class="card-body">
                        <h5 class="card-title">Event Name</h5>
                        <p class="card-text">Short description of the event.</p>
                        <a href="event-details.php?id=1" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- Repeat for more events -->
        </div>
    </section>

    <?php include BASE_PATH . "/app/views/layouts/footer.php"; ?>

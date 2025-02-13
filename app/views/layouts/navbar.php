<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 70px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo ROOT; ?>">Event Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT . '/events/dashboard'; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href='<?php echo ROOT . "/events/register" ?>'>Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT . '/auth/logout'; ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT . '/auth/login'; ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT . '/auth/register'; ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="content my-3">
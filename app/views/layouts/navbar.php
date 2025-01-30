<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo ROOT; ?>">Event Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT; ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT . '/auth/login'; ?>">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT . '/auth/register'; ?>">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

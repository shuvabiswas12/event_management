<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Ensure full-page height */
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Sticky Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Make space for navbar */
        .content {
            flex: 1;
            padding-top: 56px;
            /* Adjust this based on navbar height */
        }

        /* Sticky Footer */
        footer {
            position: sticky;
            bottom: 0;
            width: 100%;
        }

        .error-container {
            text-align: center;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .error-container h1 {
            font-size: 8rem;
            font-weight: bold;
            color: #dc3545;
        }

        .error-container p {
            font-size: 1.5rem;
            color: #6c757d;
        }

        .btn-back {
            margin-top: 20px;
            font-size: 1.2rem;
            padding: 10px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
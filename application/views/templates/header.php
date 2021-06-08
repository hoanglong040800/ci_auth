<html>

<head>
    <title><?= $title ?></title>

    <link rel="icon" href="https://image.flaticon.com/icons/png/128/1791/1791961.png">
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
        <div class="container">
            <a href="<?= base_url() ?>" class="navbar-brand">CI Auth</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('about') ?>">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('users') ?>">Users</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('register') ?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
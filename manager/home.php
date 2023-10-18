<?php

session_start();
include '../DB/connection.php';

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>

    <!--Favicons-->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Fonts-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">

    <!-- CSS Files For Plugin -->


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Plugin -->
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_index.php' ?>
    <br>
    <!-- Team Section -->
    <br><br><br><br><br><br><br>
    <span class="w3-jumbo w3-monospace w3-margin w3-center w3-wide 12%">
        Bookstore Details
    </span>
    <br><br>
    <span class="w3-small w3-monospace w3-margin w3-center w3-wide 12%">
    "A book is a device to ignite the imagination."
    </span>
    <br><br><br>
    <?php include '../partials/footer.php' ?>
</body>
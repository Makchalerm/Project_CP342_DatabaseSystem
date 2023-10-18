<?php 
    include "DB/connection.php" 
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!--Favicons-->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">

    <!-- CSS Files For Plugin -->


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Plugin -->
</head>

<body class="w3-theme-l8">
    <?php include 'partials/navbar_index.php' ?>
    <div class="w3-container w3-third w3-display-middle">
        <form class="w3-center w3-white w3-card-4" action="login/login.php" method="post">
            <div class="w3-padding-16 w3-margin">
            <div class="w3-container w3-white">
    <h2 style="text-shadow:1px 1px"> Bookstore Details </h2>
</div>

      
                <input type="password" id="prefixInside" name="emppass" class="w3-input w3-border w3-light-grey" style="font-family: FontAwesome;" placeholder="ID CARD"><br>
                <?php
                if (isset($_GET['message'])) { ?>
                    <p class="w3-center text-danger">** <?php echo $_GET['message'] ?> **</p>
                <?php } ?>

                <button type="submit" name="login" class="w3-button w3-black" style="width:25%">Login</button>
            </div>
        </form>
    </div>

    <?php include 'partials/footer.php' ?>
</body>
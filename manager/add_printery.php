<?php

session_start();
include '../DB/connection.php';

if(isset($_POST['insert']) ) {

    $phonePatt = "/[0-9]{9}/i";

    if($_POST['pname']  == "" || $_POST['paddress'] == "" || $_POST['ptel'] == "") {
        $message = "Please fill out completely in the form.";
        header("Location: add_printery.php?message=$message");
        exit;
    }else if(preg_match($phonePatt, $_POST['ptel']) == 0) {
        $message = "Phone Pattern Incorrect";
        header("Location: add_printery.php?message=$message");
        exit;
    }else {
        $sql = "INSERT INTO printery (pname, paddress, ptel)
        VALUES (?, ?, ?)";
        $insert = $pdo->prepare($sql);
        $insert->bindValue(1, $_POST['pname'], PDO::PARAM_STR);
        $insert->bindValue(2, $_POST['paddress'], PDO::PARAM_STR);
        $insert->bindValue(3, $_POST['ptel'], PDO::PARAM_STR);
        $insert->execute();

        header("Location: printery.php");
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Printery</title>

    <!--Favicons-->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">

    <!-- CSS Files For Plugin -->


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Plugin -->
</head>

<body>
    <?php include '../partials/navbar_manager_printery.php' ?>
    <br>
    <div class="w3-row">
        <div class="w3-col m4 w3-left w3-container w3-center" style="width: 350px">
            <br>
        </div>
        <div class="w3-col m4 w3-right w3-container w3-center" style="width: 350px">
            <br>
        </div>
        <div class="w3-card-4 w3-margin w3-rest" style="background-color: white;">
            <form class="w3-container" action="#" method="POST">
                <div class="w3-container">
                    <p class="w3-xxxlarge w3-margin">ADD Printery</p>
                    <hr><br>

                    <label><span>Printery Name : </span></label>
                    <input type="text" name="pname" id="pname" class="w3-input w3-border"><br>

                    <label><span>Printery Address : </span></label>
                    <textarea type="text" name="paddress" id="paddress" class="w3-input w3-border"></textarea><br>

                    <label><span>Tel : </span></label>
                    <input type="text" name="ptel" maxlength="9" id="ptel" class="w3-input w3-border"><br>
                    <hr>

                    <?php if (isset($_GET['message'])) { ?>
                        <p class="text-danger text-left">** <?php echo $_GET['message'] ?> **</p>
                    <?php } ?>
                    <button type="submit" name="insert" value="submit" class="w3-button w3-black w3-round-large">Confirm</button>
                </div><br>
            </form>
        </div>
    </div>
</body>

</html>
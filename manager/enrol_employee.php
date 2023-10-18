<?php

session_start();

include '../DB/connection.php';

$sql = "";
$phonePattern = "/[0-9]{10}/i";
$idCardPattern = "/[0-9]{13}/i";
$message = "";

if (isset($_POST['insert'])) {
    $firstname = trim($_POST['efirstname']);
    $lastname = trim($_POST['elastname']);
    $ecard = (int)trim($_POST['ecard_id']);
    $tel = trim($_POST['etel']);
    $address = trim($_POST['eaddress']);
    $gender = trim($_POST['egender']);
    $role = trim($_POST['erole']);
    $img = $_POST['image'];
    if ($firstname == "" || $lastname == "" || $ecard == "" || $tel == "" || $address == "" || $gender == "" || $role == "") {
        $message = " Please fill out completely in the form. ";
        header("Location: enrol_employee.php?message=$message");
        exit;
    }
    if (preg_match($idCardPattern, $ecard) == 0) {
        $message = "ID Card Incorrect";
        header("Location: enrol_employee.php?message=$message");
        exit;
    }
    if (preg_match($phonePattern, $tel) == 0) {
        $message = "Phone Pattern Incorrect";
        header("Location: enrol_employee.php?message=$message");
        exit;
    }
    $sql = "SELECT ecard_id FROM employee WHERE ecard_id = ? AND status = false";
    $ecard_id = $pdo->prepare($sql);
    $ecard_id->bindValue(1, (int)$ecard, PDO::PARAM_INT);
    $ecard_id->execute();

    if ($ecard_id->rowCount() > 0) {
        $message = "ID Card Incorrect ";
        header("Location: enrol_employee.php?message=$message");
        exit;
    }

    $sql = "INSERT INTO employee (erole, efirstname, elastname, ecard_id, eaddress, etel, egender, status, img_id) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $role, PDO::PARAM_STR);
    $result->bindValue(2, $firstname, PDO::PARAM_STR);
    $result->bindValue(3, $lastname, PDO::PARAM_STR);
    $result->bindValue(4, $ecard, PDO::PARAM_INT);
    $result->bindValue(5, $address, PDO::PARAM_STR);
    $result->bindValue(6, $tel, PDO::PARAM_STR);
    $result->bindValue(7, $gender, PDO::PARAM_STR);
    $result->bindValue(8, false, PDO::PARAM_BOOL);
    $result->bindValue(9, $img, PDO::PARAM_STR);
    $result->execute();
    $message = "Succes to register";
    header("Location: enrol_employee.php?message=$message");
    exit;
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrol Employee</title>

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

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_emp.php' ?>
    <br>
    <div class="w3-row">
        <div class="w3-col m4 w3-left w3-container w3-center" style="width: 350px">
            <br>
        </div>
        <div class="w3-col m4 w3-right w3-container w3-center" style="width: 350px">
            <br>
        </div>
        <div class="w3-card-4 w3-margin w3-rest" style="background-color: white;">
            <form action="#" class="w3-container" method="POST">
                <div class="container">
                    <p class="w3-xxxlarge w3-margin">Bookstore Details</p>
                    <hr><br>

                    <label><span>First Name : </span></label>
                    <input type="text" name="efirstname" class="w3-input w3-border" value=""><br>

                    <label><span>Last Name : </span></label>
                    <input type="text" name="elastname" class="w3-input w3-border" value=""><br>

                    <label><span> Gender : </span></label>
                    <input type="text" name="egender" class="w3-input w3-border" value=""><br>

                    <label><span> Tel : </span></label>
                    <input type="text" name="etel" maxlength="10" class="w3-input w3-border" value=""><br>

                    <label><span> Card ID : </span></label>
                    <input type="text" name="ecard_id" maxlength="13" class="w3-input w3-border" value=""><br>

                    <label><span> Address : </span></label>
                    <textarea type="text" name="eaddress" class="w3-input w3-border" value=""></textarea><br>

                    <label><span> Role : </span></label>
                    <select id="select" name="erole" class="w3-select w3-border">
                        <option value="Employee" selected>Employee</option>
                        <option value="Manager">Manager</option>
                    </select><br><br>
                    <label for="image">Upload Image: </label><br>
                    <input type="file" accept="image/x-png;image/gif;image/jpeg" name="image" id="image"><br><br>
                    <hr>

                    <?php if (isset($_GET['message'])) { ?>
                        <p class="text-danger text-right">** <?php echo $_GET['message'] ?> **</p>
                    <?php } ?>
                    <button type="submit" name="insert" value="submit" class="w3-button w3-black w3-round-large">Submit</button>
                </div><br>
            </form>
        </div>
    </div>
</body>
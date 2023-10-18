<?php

session_start();

include '../DB/connection.php';
$name = "";
$num = 0;
$sql = "SELECT * FROM employee Where status = true ORDER BY emp_id";
$result = $pdo->prepare($sql);
$result->execute();
if (isset($_POST['searchEmp'])) {
    if (trim($_POST['empName']) != "") {

        $name = trim($_POST['empName']);
        $sql = "SELECT * FROM employee 
        WHERE status = true AND (efirstname LIKE ? OR elastname LIKE ?)
        ORDER BY emp_id";
        $result = $pdo->prepare($sql);
        $result->bindValue(1, "%$name%", PDO::PARAM_STR);
        $result->bindValue(2, "%$name%", PDO::PARAM_STR);
    } else if (trim($_POST['empId']) != "") {
        $num = (int)(trim($_POST['empId']));
        $sql = "SELECT * FROM employee Where status = true AND emp_id = ?
        ORDER BY emp_id";
        $result = $pdo->prepare($sql);
        $result->bindValue(1, $num, PDO::PARAM_INT);
    } else if (trim($_POST['ecard_id']) != "") {
        $ecard_id = (int)(trim($_POST['ecard_id']));
        $sql = "SELECT * FROM employee Where status = true AND ecard_id = ?
        ORDER BY emp_id";
        $result = $pdo->prepare($sql);
        $result->bindValue(1, $ecard_id, PDO::PARAM_INT);
    } else {
        $sql = "SELECT * FROM employee Where status = true
        ORDER BY emp_id";
        $result = $pdo->prepare($sql);
    }
    $result->execute();
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>

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
    <script src="../JS/manage.js"></script>
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_emp.php' ?>
    <br>
    <div class="w3-row">
        <div class="w3-col w3-left w3-container w3-center" style="width:100px">
            <br>
        </div>
        <div class="w3-col w3-right w3-container w3-center" style="width:100px">
            <br>
        </div>
        <div class="w3-card-4 w3-margin w3-rest" style="background-color: white;">
            <h1 class="w3-center w3-padding">Old Employee Information</h1>
            <br>
            <div class="w3-conatiner">
                <form class="row" method="POST" action="">
                    <div class="col-1"></div>
                    <div class="col-3">
                        <p> Name </p>
                        <input class="form-control" type="text" aria-label="Search" name="empName" id="searchName" placeholder="First - Last">
                    </div>
                    <div class="col-3">
                        <p> ID </p>
                        <input class="form-control" type="text" aria-label="Search" name="empId" id="searchId" placeholder="ID">
                    </div>
                    <div class="col-3">
                        <p> ID Card </p>
                        <input class="form-control" type="number" aria-label="Search" name="ecard_id" maxlength="13" id="searchIdCard" placeholder="13 Digits"><br>
                    </div>
                    <div class="col-2">
                        <p><br></p>
                        <button type="submit" class="btn btn-outline-primary waves-effect" name="searchEmp" style="height:35.75px"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>


            <?php for ($i = 0; $i < $result->rowCount(); $i++) { ?>
                <center>
                    <div class="row">
                        <?php while ($rs = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="col-3">
                                <div class="w3-card-4 ml-3 w3-margin" style="width: 18rem;">
                                    <img src="../img/employee/<?php echo $rs['img_id'] ?>" class="card-img-top w3-margin" alt="..." style="width:15rem; height:13rem;">
                                    <div class="card-body w3-left-align">
                                        <h5 class="card-title text-center">
                                            ID <?php echo $rs['emp_id'] ?>
                                        </h5>
                                        <p>ROLE: <span><?php echo $rs['erole'] ?></span></p>
                                        <p>Name: <span><?php echo $rs['efirstname'] ?></span> <span><?php echo $rs['elastname'] ?></span></p>
                                        <p>Gender: <span><?php echo $rs['egender'] ?></span></p>
                                        <p>ID Card: <span><?php echo $rs['ecard_id'] ?></span></p>
                                        <p>Address: <span><?php echo $rs['eaddress'] ?></span></p>
                                        <p>Tel: <span><?php echo $rs['etel'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </center>
            <?php } ?><br>
        </div>
    </div>
</body>
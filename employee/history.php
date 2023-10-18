<?php

session_start();
include "../DB/connection.php";
$emp_id = $_SESSION['emp_id'];

if (isset($_POST['searchTransaction'])) {
    if ($_POST['date1'] == null || $_POST['date2'] == null) {
        $sql = "SELECT bill_id, sum(quantitycheck) as quantity, efirstname, elastname, btotal, bdate, btime 
        FROM bill NATURAL JOIN checkbill NATURAL JOIN employee
        WHERE bill.bill_id = checkbill.bill_id AND emp_id = $emp_id
        GROUP BY bill_id, btotal, bdate, btime, efirstname, elastname
        ORDER BY bill_id ASC";
    } else if ($_POST['date1'] != null && $_POST['date2'] != null) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $sql = "SELECT bill_id, sum(quantitycheck) as quantity, efirstname, elastname, btotal, bdate, btime 
        FROM bill NATURAL JOIN checkbill NATURAL JOIN employee
        WHERE bill.bill_id = checkbill.bill_id AND bdate BETWEEN '$date1' AND '$date2' AND emp_id = $emp_id
        GROUP BY bill_id, btotal, bdate, btime, efirstname, elastname
        ORDER BY bill_id ASC";
    } else if ($_POST['date1'] == $_POST['date2']) {
        $sql = "SELECT bill_id, sum(quantitycheck) as quantity, efirstname, elastname, btotal, bdate, btime 
        FROM bill NATURAL JOIN checkbill NATURAL JOIN employee
        WHERE bill.bill_id = checkbill.bill_id AND bdate '$date1' AND emp_id = $emp_id
        GROUP BY bill_id, btotal, bdate, btime, efirstname, elastname
        ORDER BY bill_id ASC";
    }
} else {
    $sql = "SELECT bill_id, sum(quantitycheck) as quantity, efirstname, elastname, btotal, bdate, btime 
    FROM bill NATURAL JOIN checkbill NATURAL JOIN employee
    WHERE bill.bill_id = checkbill.bill_id AND emp_id = $emp_id
    GROUP BY bill_id, btotal, bdate, btime, efirstname, elastname
    ORDER BY bill_id ASC";
}
$query = $pdo->query($sql);
$query->execute();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Financial</title>

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../CSS/print.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Plugin -->
    <script type="text/javascript" src="../JS/cashier.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_emp.php' ?>
    <br>
    <div class="w3-card-4 container w3-white">
        <h1 class="w3-center w3-padding">Find a Receipts</h1>
        <form method="post" action="#">
            <div class="row mt-2">
                <div class="col-3 mt-3"></div>
                <div class="col-3 mt-3">
                    <label for="Date">Since Date:</label>
                    <input type="date" id="date1" class="form-control" placeholder="" name="date1">
                </div>
                <div class="col-3 mt-3">
                    <label for="appt">Up to Date:</label>
                    <input type="date" id="date2" class="form-control" placeholder="" name="date2">
                </div>
                <div class="col-3 " style="margin-top: 40px;">
                    <button type="submit" name="searchTransaction" class="btn btn-outline-primary waves-effect"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <br>
        <div class="row ">
            <div class="col-10 container">
                <table class="table table-hover table-bordered" style="background-color: white;">
                    <thead class="text-center">
                        <tr>
                            <th class="th-lg">ID</th>
                            <th class="th-lg">Time</th>
                            <th class="th-lg">Date</th>
                            <th class="th-lg">Option</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $result['bill_id'] ?></td>
                                <td><?php echo explode(":", $result['btime'])[0] . ":" . explode(":", $result['btime'])[1] ?> </td>
                                <td><?php echo explode("-", $result['bdate'])[2] . "/" . explode("-", $result['bdate'])[1] . "/" . explode("-", $result['bdate'])[0] ?></td>
                                <td class="text-center"><a data-id="<?php echo $result['bill_id'] ?>" href="bill.php?id=<?php echo $result['bill_id'] ?>" class="show-receipt"><i class='fas fa-receipt'></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div><br>
    </div>

    <div class="w3-modal" id="info">
        <div class="w3-modal-content w3-animate-zoom w3-card-4" style="max-width:600px;">
            <div class="w3-conatiner w3-theme-d3">
                <p class="w3-xxxlarge w3-center w3-margin">Account</p>
            </div>

            <div class="w3-container w3-center">
            <img src="../img/employee/<?php echo $_SESSION['img_id'] ?>" class="img-fluid animated zoomIn" alt=".." style="width: 10rem">
                <br><br>
                <div class="w3-container">
                    <div class="w3-row">
                        <div class="col-md-12" style="font-size:25px;"><strong><?php echo $_SESSION['efirstname'] . " " . $_SESSION['elastname']; ?></strong>
                        </div>
                    </div>
                    <br>
                    <div class="w3-row">
                        <div class="col-md-12 " style="font-size:18px;">Gender: <?php echo $_SESSION['egender'] ?></div>
                    </div>
                    <br>
                    <div class="w3-row">
                        <div class="col-md-12 " style="font-size:18px;">Address: <?php echo $_SESSION['eaddress'] ?></div>
                    </div>
                    <br>
                    <div class="w3-row">
                        <div class="col-md-12 " style="font-size:18px;">Tel: <?php echo $_SESSION['etel'] ?></div>
                    </div>
                    <br>
                    <div class="w3-row">
                        <div class="col-md-12" style="font-size:18px;">Role: <?php echo $_SESSION['erole']; ?></div>
                    </div>
                    <br>
                </div>
            </div>

            <div class="w3-container">
                <div class="w3-container w3-right w3-margin ">
                    <button class="btn btn-outline-danger waves-effect" onclick="document.getElementById('info').style.display='none'">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
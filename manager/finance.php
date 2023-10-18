<?php
session_start();

include '../DB/connection.php';

if (isset($_POST['searchTransaction'])) {

    if ($_POST['date1'] == null || $_POST['date2'] == null) {
        $sql = "SELECT efirstname, elastname, btime, bdate, btotal, bill_id
        FROM bill NATURAL JOIN employee
        WHERE bill_id = bill_id";
        $result = $pdo->prepare($sql);
        $result->execute();

        $sql = "SELECT sum(btotal) as total, count(bill_id) as count
        FROM bill NATURAL JOIN employee
        WHERE bill_id = bill_id";
        $result2 = $pdo->prepare($sql);
        $result2->execute();
        $total_count = $result2->fetch(PDO::FETCH_ASSOC);
    } else if ($_POST['date1'] != null && $_POST['date2'] != null) {
        $sql = "SELECT efirstname, elastname, btime, bdate, btotal, bill_id
        FROM bill NATURAL JOIN employee
        WHERE bill_id = bill_id AND bdate BETWEEN ? AND ?";
        $result = $pdo->prepare($sql);
        $result->bindValue(1, $_POST['date1'], PDO::PARAM_STR);
        $result->bindValue(2, $_POST['date2'], PDO::PARAM_STR);
        $result->execute();

        $sql = "SELECT sum(btotal) as total, count(bill_id) as count
        FROM bill NATURAL JOIN employee
        WHERE bill_id = bill_id AND bdate BETWEEN ? AND ?";
        $result2 = $pdo->prepare($sql);
        $result2->bindValue(1, $_POST['date1'], PDO::PARAM_STR);
        $result2->bindValue(2, $_POST['date2'], PDO::PARAM_STR);
        $result2->execute();
        $total_count = $result2->fetch(PDO::FETCH_ASSOC);
    } else if ($_POST['date1'] == $_POST['date2']) {
        $sql = "SELECT efirstname, elastname, btime, bdate, btotal, bill_id
        FROM bill NATURAL JOIN employee
        WHERE bill_id = bill_id AND bdate = ?";
        $result = $pdo->prepare($sql);
        $result->bindValue(1, $_POST['date1'], PDO::PARAM_STR);
        $result->execute();

        $sql = "SELECT sum(btotal) as total, count(bill_id) as count
        FROM bill NATURAL JOIN employee
        WHERE bill_id = bill_id AND bdate = ?";
        $result2 = $pdo->prepare($sql);
        $result2->bindValue(1, $_POST['date1'], PDO::PARAM_STR);
        $result2->execute();
        $total_count = $result2->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $sql = "SELECT efirstname, elastname, btime, bdate, btotal, bill_id
      FROM bill NATURAL JOIN employee
      WHERE bill.emp_id = employee.emp_id AND bill_id = bill_id";
    $result = $pdo->prepare($sql);
    $result->execute();

    $sql = "SELECT sum(btotal) as total, count(bill_id) as count
      FROM bill NATURAL JOIN employee
      WHERE bill.emp_id = employee.emp_id AND bill_id = bill_id";
    $result2 = $pdo->prepare($sql);
    $result2->execute();
    $total_count = $result2->fetch(PDO::FETCH_ASSOC);
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance</title>

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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_finance.php' ?>
    <br>
    <div class="w3-card-4 container w3-white">
        <h1 class="w3-center w3-padding">Check Finance</h1>
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
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <table class="table table-hover table-bordered" style="background-color: white;">
                    <thead class="text-center">
                        <tr>
                            <th class="th-lg">Employee Name</th>
                            <th class="th-lg">Time</th>
                            <th class="th-lg">Date</th>
                            <th class="th-lg">Total(฿)</th>
                            <th class="th-lg">Option</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php while ($rs = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $rs['efirstname'] . " " . $rs['elastname'] ?></td>
                                <td><?php echo explode(":", $rs['btime'])[0] . ":" . explode(":", $rs['btime'])[1] ?></td>
                                <td><?php echo explode("-", $rs['bdate'])[2] . "/" . explode("-", $rs['bdate'])[1] . "/" . explode("-", $rs['bdate'])[0] ?></td>
                                <td><?php echo $rs['btotal'] ?></td>
                                <td class="text-center"><a href="showbill.php?id=<?php echo $rs['bill_id'] ?>"><i class='fas fa-receipt'></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
        </div>

        <div class="row">
            <div class="col-6"></div>
            <div class="col-5">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <h5 class="w3-right">All Receipts</h5>
                        </div>
                        <div class="col-1">
                            <h5 class="w3-center"><?php echo $total_count['count'] ?></h5>
                        </div>
                        <div class="col-2">
                            <h5>Amount</h5>
                        </div>
                        <div class="col-1">
                            <h5 class="w3-center">|</h5>
                        </div>
                        <div class="col-2">
                            <h5 class="w3-center">Total</h5>
                        </div>
                        <div class="col-2">
                            <h5 class="w3-center"><?php echo $total_count['total'] ?></h5>
                        </div>
                        <div class="col-1">
                            <h5 class="w3-center">฿</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</body>
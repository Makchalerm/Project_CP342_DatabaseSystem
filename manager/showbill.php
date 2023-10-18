<?php

session_start();

include '../DB/connection.php';

$id = (int)$_GET['id'];

$sqlBook = "SELECT quantitycheck as qty, bname as bookname, (quantitycheck * bprice) as price,  sname as seriesname
    FROM checkbill NATURAL JOIN book NATURAL JOIN series
    WHERE checkbill.book_id = book.book_id AND bill_id = ?";
$query1 = $pdo->prepare($sqlBook);
$query1->bindValue(1, $id, PDO::PARAM_INT);
$query1->execute();


$sqlOverAll = "SELECT sum(quantitycheck) as quantitycheck, btotal as btotal, bdate, btime, bcash, efirstname, elastname
    FROM bill NATURAL JOIN checkbill NATURAL JOIN employee
    WHERE bill.bill_id = checkbill.bill_id AND bill_id = ?
    GROUP BY btotal, bdate, btime, bcash, efirstname, elastname";
$query2 = $pdo->prepare($sqlOverAll);
$query2->bindValue(1, $id, PDO::PARAM_INT);
$query2->execute();
$result2 = $query2->fetch(PDO::FETCH_ASSOC);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>

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
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_emp.php' ?>
    <br>
    <div class="container w3-white w3-card-4"><br>
        <div class="w3-container w3-white print_bill">
            <div class="row">
                <div class="w3-container">
                    <p class="w3-xlarge w3-center">BookStore Details Receipts</p>
                    <table class="table table-hover table-bordered text-center" style="margin-top: 20px;">
                        <thead class="text-center ">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Series</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($result1 = $query1->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?php echo $result1['bookname'] ?></td>
                                    <td><?php echo $result1['seriesname'] ?></td>
                                    <td><?php echo $result1['qty'] ?></td>
                                    <td><?php echo $result1['price'] ?> ฿</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row ">
                <div class="w3-container">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 t">
                            Total
                            <span><strong><?php echo $result2['quantitycheck'] ?> Quantity = <?php echo $result2['btotal'] ?> ฿</strong></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 t">
                            Cash/Change
                            <span><strong><?php echo $result2['bcash'] ?> / <?php echo $result2['bcash'] - $result2['btotal'] ?> ฿</strong></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 t">
                            Date/Time
                            <span><strong><?php echo explode("-", $result2['bdate'])[2] . "/" . explode("-", $result2['bdate'])[1] . "/" . explode("-", $result2['bdate'])[0] . " " . explode(":", $result2['btime'])[0] . ":" . explode(":", $result2['btime'])[1] ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 t">
                            Receipt By
                            <span><?php echo $result2['efirstname'] . " " . $result2['elastname'] ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="w3-container w3-center">
            <a type="button" href="home.php" class="btn btn-success">Home</a>
            <a type="button" onclick="window.print()" class="btn btn-success">Print Bill</a>
        </div>
        <br>
    </div>

</html>
<?php

session_start();
include "../DB/connection.php";
$emp_id = $_SESSION['emp_id'];

if (isset($_POST['searchTransaction'])) {
    if ($_POST['date1'] == null || $_POST['date2'] == null) {
        $sql = "SELECT ab_id, bname, abquantity, pname, abdate, abtime FROM addbook NATURAL JOIN book NATURAL JOIN printery
            WHERE book.book_id = addbook.book_id AND book.printery_id = printery.printery_id 
            ORDER BY abdate DESC, abtime DESC";
    } else if ($_POST['date1'] != null && $_POST['date2'] != null) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        $sql = "SELECT ab_id, bname, abquantity, pname, abdate, abtime FROM addbook NATURAL JOIN book NATURAL JOIN printery
          WHERE book.book_id = addbook.book_id AND abdate BETWEEN '$date1' AND '$date2'
          ORDER BY abdate DESC, abtime DESC";
    } else if ($_POST['date1'] == $_POST['date2']) {
        $sql = "SELECT ab_id, bname, abquantity, pname, abdate, abtime FROM addbook NATURAL JOIN book NATURAL JOIN printery
          WHERE book.book_id = addbook.book_id AND abdate '$date1'
          ORDER BY abdate DESC, abtime DESC";
    }
} else {
    $sql = "SELECT ab_id, bname, abquantity, pname, abdate, abtime FROM addbook NATURAL JOIN book NATURAL JOIN printery
    WHERE book.book_id = addbook.book_id AND book.printery_id = printery.printery_id 
    ORDER BY abdate DESC, abtime DESC";
}
$query = $pdo->query($sql);
$query->execute();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History of Stock Imported</title>

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
    <?php include '../partials/navbar_manager_store.php' ?>
    <br>
    <div class="w3-card-4 container w3-white">
        <h1 class="w3-center w3-padding">Find a Import</h1>
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
                            <th class="th-lg">Book Name</th>
                            <th class="th-lg">Quantity</th>
                            <th class="th-lg">Printery Name</th>
                            <th class="th-lg">Time</th>
                            <th class="th-lg">Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $result['ab_id'] ?></td>
                                <td><?php echo $result['bname'] ?></td>
                                <td><?php echo $result['abquantity'] ?></td>
                                <td><?php echo $result['pname'] ?></td>
                                <td><?php echo explode(":", $result['abtime'])[0] . ":" . explode(":", $result['abtime'])[1] ?> </td>
                                <td><?php echo explode("-", $result['abdate'])[2] . "/" . explode("-", $result['abdate'])[1] . "/" . explode("-", $result['abdate'])[0] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div><br>
    </div>
</body>
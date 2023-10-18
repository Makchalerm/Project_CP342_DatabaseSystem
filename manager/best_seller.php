<?php
session_start();
include '../DB/connection.php';
$month = 1;

if (isset($_POST['month'])) {
    if ($_POST['month'] == 1) {
        $monthname = 'January';
    };
    if ($_POST['month'] == 2) {
        $monthname = 'February';
    };
    if ($_POST['month'] == 3) {
        $monthname = 'March';
    };
    if ($_POST['month'] == 4) {
        $monthname = 'April';
    };
    if ($_POST['month'] == 5) {
        $monthname = 'May';
    };
    if ($_POST['month'] == 6) {
        $monthname = 'June';
    };
    if ($_POST['month'] == 7) {
        $monthname = 'July';
    };
    if ($_POST['month'] == 8) {
        $monthname = 'August';
    };
    if ($_POST['month'] == 9) {
        $monthname = 'September';
    };
    if ($_POST['month'] == 10) {
        $monthname = 'October';
    };
    if ($_POST['month'] == 11) {
        $monthname = 'November';
    };
    if ($_POST['month'] == 12) {
        $monthname = 'December';
    };

    $sql1 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = ? AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 ";

    $result1 = $pdo->prepare($sql1);
    $result1->bindValue(1, $_POST['month'], PDO::PARAM_INT);
    $result1->execute();
    if ($result1->rowCount() == 1) {
        $a1 = $result1->fetch(PDO::FETCH_ASSOC);
        $bookname1 = $a1['bname'];
        $total1 = $a1['quantitysum'];
    } else {
        $bookname1 = 'book1';
        $total1 = 'total1';
    }

    $sql2 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = ?  AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 1 ";

    $result2 = $pdo->prepare($sql2);
    $result2->bindValue(1, $_POST['month'], PDO::PARAM_INT);
    $result2->execute();
    if ($result2->rowCount() == 1) {
        $a2 = $result2->fetch(PDO::FETCH_ASSOC);
        $bookname2 = $a2['bname'];
        $total2 = $a2['quantitysum'];
    } else {
        $bookname2 = 'book2';
        $total2 = 'total2';
    }

    $sql3 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = ? AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 2";
    $result3 = $pdo->prepare($sql3);
    $result3->bindValue(1, $_POST['month'], PDO::PARAM_INT);
    $result3->execute();
    if ($result3->rowCount() == 1) {
        $a3 = $result3->fetch(PDO::FETCH_ASSOC);
        $bookname3 = $a3['bname'];
        $total3 = $a3['quantitysum'];
    } else {
        $bookname3 = 'book3';
        $total3 = 'total3';
    }

    $sql4 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = ?  AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 3 ";
    $result4 = $pdo->prepare($sql4);
    $result4->bindValue(1, $_POST['month'], PDO::PARAM_INT);
    $result4->execute();
    if ($result4->rowCount() == 1) {
        $a4 = $result4->fetch(PDO::FETCH_ASSOC);
        $bookname4 = $a4['bname'];
        $total4 = $a4['quantitysum'];
    } else {
        $bookname4 = 'book4';
        $total4 = 'total4';
    }

    $sql5 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = ?  AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 4 ";
    $result5 = $pdo->prepare($sql5);
    $result5->bindValue(1, $_POST['month'], PDO::PARAM_INT);
    $result5->execute();
    if ($result5->rowCount() == 1) {
        $a5 = $result5->fetch(PDO::FETCH_ASSOC);
        $bookname5 = $a5['bname'];
        $total5 = $a5['quantitysum'];
    } else {
        $bookname5 = 'book5';
        $total5 = 'total5';
    }
} else {

    $monthname = 'January';
    $sql1 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = 1 AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 ";
    $result1 = $pdo->prepare($sql1);
    $result1->execute();
    if ($result1->rowCount() == 1) {
        $a1 = $result1->fetch(PDO::FETCH_ASSOC);
        $bookname1 = $a1['bname'];
        $total1 = $a1['quantitysum'];
    } else {
        $bookname1 = 'book1';
        $total1 = 'total1';
    }
    $sql2 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = 1  AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 1 ";
    $result2 = $pdo->prepare($sql2);
    $result2->execute();
    if ($result2->rowCount() == 1) {
        $a2 = $result2->fetch(PDO::FETCH_ASSOC);
        $bookname2 = $a2['bname'];
        $total2 = $a2['quantitysum'];
    } else {
        $bookname2 = 'book2';
        $total2 = 'total2';
    }

    $sql3 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = 1 AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 2";
    $result3 = $pdo->prepare($sql3);
    $result3->execute();
    if ($result3->rowCount() == 1) {
        $a3 = $result3->fetch(PDO::FETCH_ASSOC);
        $bookname3 = $a3['bname'];
        $total3 = $a3['quantitysum'];
    } else {
        $bookname3 = 'book3';
        $total3 = 'total3';
    }

    $sql4 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = 1  AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 3 ";
    $result4 = $pdo->prepare($sql4);
    $result4->execute();
    if ($result4->rowCount() == 1) {
        $a4 = $result4->fetch(PDO::FETCH_ASSOC);
        $bookname4 = $a4['bname'];
        $total4 = $a4['quantitysum'];
    } else {
        $bookname4 = 'book4';
        $total4 = 'total4';
    }
    $sql5 = "SELECT DISTINCT bname, sum(quantitycheck) as quantitysum
            FROM checkbill NATURAL JOIN bill NATURAL JOIN book
            WHERE bill_id = bill_id AND EXTRACT (MONTH FROM bdate) = 1  AND EXTRACT (YEAR FROM bdate) = 2022
            GROUP BY bname ORDER BY quantitysum DESC LIMIT  1 OFFSET 4 ";
    $result5 = $pdo->prepare($sql5);
    $result5->execute();
    if ($result5->rowCount() == 1) {
        $a5 = $result5->fetch(PDO::FETCH_ASSOC);
        $bookname5 = $a5['bname'];
        $total5 = $a5['quantitysum'];
    } else {
        $bookname5 = 'book5';
        $total5 = 'total5';
    }
}

?>

<?php
echo '<script type="text/javascript">';
echo "var bookname1 = '$bookname1';";
echo '</script>';
echo '<script type="text/javascript">';
echo "var total1 = '$total1';";
echo '</script>';


?>
<?php
echo '<script type="text/javascript">';
echo "var bookname2 = '$bookname2';";
echo '</script>';
echo '<script type="text/javascript">';
echo "var total2 = '$total2';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var bookname3 = '$bookname3';";
echo '</script>';
echo '<script type="text/javascript">';
echo "var total3 = '$total3';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var bookname4 = '$bookname4';";
echo '</script>';
echo '<script type="text/javascript">';
echo "var total4 = '$total4';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var bookname5 = '$bookname5';";
echo '</script>';
echo '<script type="text/javascript">';
echo "var total5 = '$total5';";
echo '</script>';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Seller</title>

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

    <!-- Chart JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js"></script>

    <!-- JS Plugin -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_finance.php' ?>
    <br>
    <div class="w3-card-4 container w3-white">
        <h1 class="w3-center w3-padding">5 Best Seller Book of <?php echo $monthname ?></h1>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3">
                    <form method="post">
                        <select name='month'>
                            <option disabled selected>Select Month</option>
                            <option value=1>January</option>
                            <option value=2>February</option>
                            <option value=3>March</option>
                            <option value=4>April</option>
                            <option value=5>May</option>
                            <option value=6>June</option>
                            <option value=7>July</option>
                            <option value=8>August</option>
                            <option value=9>September</option>
                            <option value=10>October</option>
                            <option value=11>November</option>
                            <option value=12>December</option>
                        </select>
                        <input type='submit'>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="w3-container w3-margin">
            <canvas id="myChart" width="8" height="3.5"></canvas>
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [bookname1, bookname2, bookname3, bookname4, bookname5],
                        datasets: [{
                            label: 'Quantity ',
                            data: [total1, total2, total3, total4, total5],
                            fill: true,
                            backgroundColor: '#357a38',
                            tension: 1,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
        <br>
    </div>
</body>
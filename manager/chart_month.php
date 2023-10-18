<?php
session_start();
include '../DB/connection.php';
$month = 1;

$sql1 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 1 AND EXTRACT (YEAR FROM bdate) = 2022";
$result1 = $pdo->prepare($sql1);
$result1->execute();
$a1 = $result1->fetch(PDO::FETCH_ASSOC);
$total1 = $a1['total'];

$sql2 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 2 AND EXTRACT (YEAR FROM bdate) = 2022";
$result2 = $pdo->prepare($sql2);
$result2->execute();
$a2 = $result2->fetch(PDO::FETCH_ASSOC);
$total2 = $a2['total'];

$sql3 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 3 AND EXTRACT (YEAR FROM bdate) = 2022";
$result3 = $pdo->prepare($sql3);
$result3->execute();
$a3 = $result3->fetch(PDO::FETCH_ASSOC);
$total3 = $a3['total'];

$sql4 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 4 AND EXTRACT (YEAR FROM bdate) = 2022";
$result4 = $pdo->prepare($sql4);
$result4->execute();
$a4 = $result4->fetch(PDO::FETCH_ASSOC);
$total4 = $a4['total'];

$sql5 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 5 AND EXTRACT (YEAR FROM bdate) = 2022";
$result5 = $pdo->prepare($sql5);
$result5->execute();
$a5 = $result5->fetch(PDO::FETCH_ASSOC);
$total5 = $a5['total'];

$sql6 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 6 AND EXTRACT (YEAR FROM bdate) = 2022";
$result6 = $pdo->prepare($sql6);
$result6->execute();
$a6 = $result6->fetch(PDO::FETCH_ASSOC);
$total6 = $a6['total'];

$sql7 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 7 AND EXTRACT (YEAR FROM bdate) = 2022";
$result7 = $pdo->prepare($sql7);
$result7->execute();
$a7 = $result7->fetch(PDO::FETCH_ASSOC);
$total7 = $a7['total'];

$sql8 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 8 AND EXTRACT (YEAR FROM bdate) = 2022";
$result8 = $pdo->prepare($sql8);
$result8->execute();
$a8 = $result8->fetch(PDO::FETCH_ASSOC);
$total8 = $a8['total'];

$sql9 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 9 AND EXTRACT (YEAR FROM bdate) = 2022";
$result9 = $pdo->prepare($sql9);
$result9->execute();
$a9 = $result9->fetch(PDO::FETCH_ASSOC);
$total9 = $a9['total'];

$sql10 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 10 AND EXTRACT (YEAR FROM bdate) = 2022";
$result10 = $pdo->prepare($sql10);
$result10->execute();
$a10 = $result10->fetch(PDO::FETCH_ASSOC);
$total10 = $a10['total'];

$sql11 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 11 AND EXTRACT (YEAR FROM bdate) = 2022";
$result11 = $pdo->prepare($sql11);
$result11->execute();
$a11 = $result11->fetch(PDO::FETCH_ASSOC);
$total11 = $a11['total'];

$sql12 = "SELECT sum(btotal) as total 
FROM bill NATURAL JOIN employee
WHERE emp_id = emp_id AND EXTRACT (MONTH FROM bdate) = 12 AND EXTRACT (YEAR FROM bdate) = 2022";
$result12 = $pdo->prepare($sql12);
$result12->execute();
$a12 = $result12->fetch(PDO::FETCH_ASSOC);
$total12 = $a12['total'];

$total13 = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12
?>

<?php
echo '<script type="text/javascript">';
echo "var total1 = '$total1';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total2 = '$total2';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total3 = '$total3';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total4 = '$total4';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total5 = '$total5';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total6 = '$total6';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total7 = '$total7';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total8 = '$total8';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total9 = '$total9';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total10 = '$total10';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total11 = '$total11';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total12 = '$total12';";
echo '</script>';
?>
<?php
echo '<script type="text/javascript">';
echo "var total13 = '$total13';";
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
        <h1 class="w3-center w3-padding">Monthly Balance</h1>
        <h3 class="w3-center w3-padding">Total = <?php echo $total13 ?> ฿</h3>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3">
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
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            label: 'Total(฿)',
                            data: [total1, total2, total3, total4, total5, total6, total7, total8, total9, total10, total11, total12],
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
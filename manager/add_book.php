<?php

session_start();
include '../DB/connection.php';

if (isset($_POST['add'])) {
    $category_id = (int)($_POST['category']);
    $printery_id = (int)($_POST['printery']);
    $series_id = (int)($_POST['series']);
    $bprice = (int)($_POST['bprice']);
    $bquantity = (int)($_POST['bquantity']);
    $bname = trim($_POST['bname']);
    $image = $_POST['image'];
    if (!isset($_POST['category']) || !isset($_POST['printery']) || !isset($_POST['series']) || $_POST['bname'] == "" || $_POST['bquantity'] == null || $_POST['bprice'] == null) {
        $message = "Please fill out completely in the form.";
        header("Location: add_book.php?message=$message");
        exit;
    } else {
        $sql = "INSERT INTO book (printery_id, series_id, category_id, bname, bprice, bquantity, bookimg_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $add = $pdo->prepare($sql);
        $add->bindValue(1, $printery_id, PDO::PARAM_INT);
        $add->bindValue(2, $series_id, PDO::PARAM_INT);
        $add->bindValue(3, $category_id, PDO::PARAM_INT);
        $add->bindValue(4, $bname, PDO::PARAM_STR);
        $add->bindValue(5, $bprice, PDO::PARAM_INT);
        $add->bindValue(6, $bquantity, PDO::PARAM_INT);
        $add->bindValue(7, $image, PDO::PARAM_STR);
        $add->execute();
        $message = "Success to Add Book";
        header("Location: store.php");
        exit;
    }
}

$sql = "SELECT * FROM printery ORDER BY printery_id";
$resultPrintery = $pdo->prepare($sql);
$resultPrintery->execute();

$sql = "SELECT * FROM category ORDER BY category_id";
$resultCategory = $pdo->prepare($sql);
$resultCategory->execute();

$sql = "SELECT * FROM series ORDER BY series_id";
$resultSeries = $pdo->prepare($sql);
$resultSeries->execute();

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>

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
    <?php include '../partials/navbar_manager_store.php' ?>
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
                    <p class="w3-xxxlarge w3-margin">ADD BOOK</p>
                    <hr><br>

                    <label><span>Book Name : </span></label>
                    <input type="text" name="bname" id="bname" class="w3-input w3-border"><br>

                    <label><span>Quantity : </span></label>
                    <input type="number" name="bquantity" min="1" value="1" id="bquantity" class="w3-input w3-border"><br>

                    <label><span>Price : </span></label>
                    <input type="number" name="bprice" min="1" value="1" id="bprice" class="w3-input w3-border"><br>

                    <label><span>Category : </span></label>
                    <select class="w3-select w3-border" name="category" id="select">
                        <option disabled selected>Category</option>
                        <?php while ($cate = $resultCategory->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $cate['category_id'] ?>"><?php echo $cate['ctitle'] ?></option>
                        <?php } ?>
                    </select><br><br>

                    <label><span>Printery : </span></label>
                    <select class="w3-select w3-border" name="printery" id="select">
                        <option disabled selected>Printery</option>
                        <?php while ($prt = $resultPrintery->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $prt['printery_id'] ?>"><?php echo $prt['pname'] ?></option>
                        <?php } ?>
                    </select><br><br>

                    <label><span>Series : </span></label>
                    <select class="w3-select w3-border" name="series" id="select">
                        <option disabled selected>Series</option>
                        <?php while ($ser = $resultSeries->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $ser['series_id'] ?>"><?php echo $ser['sname'] ?></option>
                        <?php } ?>
                    </select><br><br>

                    <label for="image">Upload Image: </label><br>
                    <input type="file" accept="image/x-png;image/gif;image/jpeg" name="image" id="image">
               
                    <hr>

                    <?php if (isset($_GET['message'])) { ?>
                        <p class="text-danger text-left">** <?php echo $_GET['message'] ?> **</p>
                    <?php } ?>
                    <button type="submit" name="add" value="submit" class="w3-button w3-black w3-round-large">Confirm</button>
                </div><br>
            </form>
        </div>
    </div>
</body>

</html>
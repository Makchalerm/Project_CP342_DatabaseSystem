<?php

session_start();

include "../DB/connection.php";

$sql = "SELECT * FROM book WHERE bquantity <> 0 ORDER BY book_id ASC";
$result = $pdo->prepare($sql);
$result->execute();

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Plugin -->
    <script type="text/javascript" src="../JS/cashier.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_emp.php' ?>
    <br>
    <div class="w3-row-padding w3-margin">
        <div class="w3-col m4 w3-left w3-container w3-center" style="width: 100px">
            <br>
        </div>
        <div class="w3-col m4 w3-right w3-container w3-center" style="width: 100px">
            <br>
        </div>
        <div class="w3-third text-center ">
            <div class="w3-container w3-black w3-card-4">
                <div class="row">
                    <div class="w3-col m4 w3-left w3-container w3-center" style="width: 100px">
                        <br>
                    </div>
                    <div class="w3-col m4 w3-right w3-container w3-center" style="width: 100px">
                        <br>
                    </div>
                    <div class="w3-rest w3-container w3-white">
                        <br>
                        <h1>Bill</h1>
                        <table class="table table-hover table-bordered text-center" id="cartTable" style="margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="book">
                            </tbody>
                        </table>
                        <div class="w3-container">
                            <h5 class="mb-3">Total</h5>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Total Price
                                    <span><strong id="total">0 ฿</strong></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    Cash
                                    <input type="number" name="cash" value="0" min="1" id="cash" class="form-control" style="width:25%">
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Bill By
                                    <span><?php echo $_SESSION['efirstname'] . " " . $_SESSION['elastname'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <strong>Change</strong>
                                    <span><strong id="change">0 ฿</strong></span>
                                </li>
                            </ul>

                            <button type="button" id="pay" class="btn btn-outline-success waves-effect btn-lg">Check Out</button>
                            <br>
                            <br>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="w3-half w3-container w3-white w3-card-4 w3-right">
            <div class="w3-container">
                <div class="w3-col m4 w3-left w3-container w3-center" style="width: 100px">
                    <br>
                </div>
                <div class="w3-col m4 w3-right w3-container w3-center" style="width: 100px">
                    <br>
                </div>
                <table class="w3-centered w3-hoverable" id="data_table">
                    <thead class="w3-center" id="th">
                        <tr>
                            <th>
                            </th>
                            <th>
                                Book Name
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="w3-center" id="productList">
                        <?php while ($rs = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr id="<?php echo $rs['book_id'] ?>">
                                <td class="view zoom overlay rounded m-auto col-1">
                                    <img class="img-fluid" src="../img/book/<?php echo $rs['bookimg_id'] ?> " alt="..." style="height: 5rem;">
                                </td>
                                <td class="col-5">
                                    <h5 class="w3-margin"><?php echo $rs['bname'] ?></h5>
                                </td>
                                <td class="w3-row col-3">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn"><i class="fa fa-arrow-down fa-sm"></i></button>
                                    <input style="width: 25%;" class="w3-margin quantity" type="number" value="1" min="1" max="<?php echo $rs['bquantity'] ?>" name="quantity">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn"><i class="fa fa-arrow-up fa-sm"></i></button>
                                </td>
                                <td class="col-2">
                                    <h5 class="w3-margin"><?php echo $rs['bprice'] ?> ฿</h5>
                                </td>
                                <td class="col-2">
                                    <button data-id="<?php echo $rs['book_id'] ?>" type="button" class="btn btn-outline-success waves-effect px-3 btn-sm addCart" style="margin-top: 15px;"><i class="fa fa-plus fa-sm"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table><br>
                <!-- end item -->
            </div>
        </div>


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
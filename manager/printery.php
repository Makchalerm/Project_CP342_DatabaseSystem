<?php

session_start();

include '../DB/connection.php';

if (isset($_POST['search']) && trim($_POST['pname']) != "") {
    $printery_name = trim($_POST['pname']);
    $sql = "SELECT * FROM printery 
        WHERE pname LIKE ?
        ORDER BY printery_id";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, "%$printery_name%", PDO::PARAM_STR);
    $result->execute();
    if ($result->rowCount() == 0) {
        $message = "Can not find this $printery_name";
    }
} else {
    $sql = "SELECT * FROM printery ORDER BY printery_id";
    $result = $pdo->prepare($sql);
    $result->execute();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printery</title>

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
    <script src="../JS/manage_prt.js"></script>
</head>

<body>
    <?php include '../partials/navbar_manager_printery.php' ?>

    <br>
    <div class="w3-row">
        <div class="w3-col m4 w3-left w3-container w3-center" style="width: 150px">
            <br>
        </div>
        <div class="w3-col m4 w3-right w3-container w3-center" style="width: 150px">
            <br>
        </div>
        <div class="w3-card-4 w3-margin w3-rest" style="background-color: white;">
            <h1 class="w3-center w3-padding">Printery <?php if (isset($printery_name)) {echo $printery_name;} ?></h1>
            <div class="w3-row">
                <div class="w3-col m4 w3-left w3-container w3-center" style="width: 100px">
                    <br>
                </div>
                <div class="w3-col m4 w3-right w3-container w3-center" style="width: 100px">
                    <br>
                </div>

                <!-- Search form -->
                <div class="w3-container w3-margin w3-rest">
                    <form class="row" action="" method="POST">
                        <div class="col-6">
                            <input class="form-control" type="text" name="pname" placeholder="Search Printery Name...">
                        </div>
                        <div class="col-6">
                            <button type="submit" name="search" class="btn btn-outline-primary waves-effect btn-md"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w3-row">
                <div class="w3-container">
                    <div class="w3-col m4 w3-left w3-container w3-center" style="width: 150px">
                        <br>
                    </div>
                    <div class="w3-col m4 w3-right w3-container w3-center" style="width: 150px">
                        <br>
                    </div>
                    <div class="w3-rest">
                        <table class="w3-table-all w3-centered w3-hoverable table-bordered ">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th class="">Printery Name</th>
                                    <th class="">Printery Address</th>
                                    <th class="">Tel</th>
                                    <th class="">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!isset($message)) { ?>
                                    <?php while ($rs = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class=""><?php echo $rs['pname'] ?></td>
                                            <td class=""><?php echo $rs['paddress'] ?></td>
                                            <td class=""><?php echo $rs['ptel'] ?></td>
                                            <td class="">
                                                <button type="button" data-id="<?php echo $rs['printery_id'] ?>" class="btn btn-outline-info px-3" id="show_prt"><i class="fa fa-info" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php if (isset($message)) { ?>
                            <h2 class="w3-center"><?php echo $message ?></h2>
                        <?php } ?>
                    </div><br><br>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" id="edit_prt" role="dialog">
                <div class="w3-modal-content w3-animate-zoom w3-card-4" style="max-width:600px">
                    <div class="modal-dialog modal-lg"></div>
                    <div class="w3-conatiner w3-theme-d3">
                        <p class="w3-xxxlarge w3-center w3-margin">Edit Printery</p>
                    </div>
                    <br>
                    <div class="w3-container">
                        <form>
                            <label for="textInput">Printery Name</label>
                            <input type="text" id="pname" class="form-control mb-4" placeholder="">

                            <label for="textarea">Address</label>
                            <textarea id="paddress" class="form-control mb-4" placeholder=""></textarea>

                            <label for="textInput">Tel</label>
                            <input type="text" id="ptel" name="ptel" maxlength="9" class="form-control mb-4" placeholder="">
                        </form>
                    </div>
                    <div class="w3-container">
                        <div class="w3-container w3-center w3-margin ">
                            <button class="btn btn-success" id="update_prt">Confirm</button>
                            <button class="btn btn-danger" id="cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php

session_start();
include '../DB/connection.php';
if (isset($_POST['searchBook'])) {
    $book_name = trim($_POST['bname']);
    if ($book_name != "" && isset($_POST['category']) && isset($_POST['series']) && isset($_POST['printery'])) {
        $printery = (int)$_POST['printery'];
        $category = (int)$_POST['category'];
        $series = (int)$_POST['series'];

        //Show ALL Book
        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE printery_id = ? AND bname LIKE ? AND category_id = ? AND series_id =? AND bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->bindValue(1, $printery, PDO::PARAM_INT);
        $book->bindValue(2, "%$book_name%", PDO::PARAM_STR);
        $book->bindValue(3, $category, PDO::PARAM_INT);
        $book->bindValue(4, $series, PDO::PARAM_INT);
        $book->execute();

        //Show Count Book
        $sql = "SELECT count(book_id) as count 
            FROM book
            WHERE printery_id = ? AND bname LIKE ? AND category_id = ? AND series_id =? AND bquantity = 0";
        $countBook = $pdo->prepare($sql);
        $countBook->bindValue(1, $printery, PDO::PARAM_INT);
        $countBook->bindValue(2, "%$book_name%", PDO::PARAM_STR);
        $countBook->bindValue(3, $category, PDO::PARAM_INT);
        $countBook->bindValue(4, $series, PDO::PARAM_INT);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    }else if (isset($_POST['printery']) && isset($_POST['category']) && isset($_POST['series'])) {
        $printery = (int)$_POST['printery'];
        $category = (int)$_POST['category'];
        $series = (int)$_POST['series'];

        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE printery_id = ? AND category_id = ? AND series_id = ? AND bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->bindValue(1, $printery, PDO::PARAM_INT);
        $book->bindValue(2, $category, PDO::PARAM_INT);
        $book->bindValue(3, $series, PDO::PARAM_INT);
        $book->execute();

        $sql = "SELECT count(book_id) as count 
            FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE printery_id = ? AND category_id = ? AND series_id = ? AND bquantity = 0";
        $countBook = $pdo->prepare($sql);
        $countBook->bindValue(1, $printery, PDO::PARAM_INT);
        $countBook->bindValue(2, $category, PDO::PARAM_INT);
        $countBook->bindValue(3, $series, PDO::PARAM_INT);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    } else if ($book_name != "") {
        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE bname LIKE ? AND bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->bindValue(1, "%$book_name%", PDO::PARAM_STR);
        $book->execute();

        $sql = "SELECT count(book_id) as count 
            FROM book 
            WHERE bname LIKE ? AND bquantity <> 0";
        $countBook = $pdo->prepare($sql);
        $countBook->bindValue(1, "%$book_name%", PDO::PARAM_STR);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    } else if (isset($_POST['printery'])) {
        $printery = (int)$_POST['printery'];

        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE printery_id = ? AND bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->bindValue(1, $printery, PDO::PARAM_INT);
        $book->execute();

        $sql = "SELECT count(book_id) as count 
            FROM book NATURAL JOIN printery
            WHERE printery_id = ? AND bquantity = 0";
        $countBook = $pdo->prepare($sql);
        $countBook->bindValue(1, $printery, PDO::PARAM_INT);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    } else if (isset($_POST['category'])) {
        $category = (int)$_POST['category'];

        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE category_id = ? AND bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->bindValue(1, $category, PDO::PARAM_INT);
        $book->execute();

        $sql = "SELECT count(book_id) as count 
            FROM book NATURAL JOIN category
            WHERE category_id = ? AND bquantity = 0";
        $countBook = $pdo->prepare($sql);
        $countBook->bindValue(1, $category, PDO::PARAM_INT);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    } else if (isset($_POST['series'])) {
        $series = (int)$_POST['series'];

        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE series_id = ? AND bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->bindValue(1, $series, PDO::PARAM_INT);
        $book->execute();

        $sql = "SELECT count(book_id) as count 
            FROM book NATURAL JOIN series
            WHERE series_id = ? AND bquantity = 0";
        $countBook = $pdo->prepare($sql);
        $countBook->bindValue(1, $series, PDO::PARAM_INT);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
            WHERE bquantity = 0
            ORDER BY book_id";
        $book = $pdo->prepare($sql);
        $book->execute();

        $sql = "SELECT count(book_id) as count FROM book WHERE bquantity = 0";
        $countBook = $pdo->prepare($sql);
        $countBook->execute();
        $count = $countBook->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $sql = "SELECT * FROM book NATURAL JOIN printery NATURAL JOIN category NATURAL JOIN series
        WHERE bquantity = 0
        ORDER BY book_id";
    $book = $pdo->prepare($sql);
    $book->execute();

    $sql = "SELECT count(book_id) as count FROM book WHERE bquantity = 0";
    $countBook = $pdo->prepare($sql);
    $countBook->execute();
    $count = $countBook->fetch(PDO::FETCH_ASSOC);
}
$sql = "SELECT * FROM printery ORDER BY printery_id";
$prt = $pdo->prepare($sql);
$prt->execute();

$sql = "SELECT * FROM category ORDER BY category_id";
$cat = $pdo->prepare($sql);
$cat->execute();

$sql = "SELECT * FROM series ORDER BY series_id";
$ser = $pdo->prepare($sql);
$ser->execute();

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>

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
    <script src="../JS/manage_book.js"></script>
</head>

<body class="w3-theme-l5">
    <?php include '../partials/navbar_manager_store.php' ?>
    <br>
    <div class="w3-row">
        <div class="w3-col m4 w3-left w3-container w3-center" style="width: 150px">
            <br>
        </div>
        <div class="w3-col m4 w3-right w3-container w3-center" style="width: 150px">
            <br>
        </div>
        <div class="w3-card-4 w3-margin w3-rest" style="background-color: white;">
            <h1 class="w3-center w3-padding">Out of Stock</h1>
            <div class="w3-row">
                <div class="w3-col m4 w3-left w3-container w3-center" style="width: 100px">
                    <br>
                </div>
                <div class="w3-col m4 w3-right w3-container w3-center" style="width: 100px">
                    <br>
                </div>
                <div class="w3-conatainer w3-margin w3-rest">
                    <form class="w3-row-padding" method="POST" action="">
                        <div class="w3-quarter">
                            <input class="w3-input w3-border" type="text" placeholder="Search Book Name...." name="bname">
                        </div>
                        <div class="w3-quarter">
                            <select name="printery" class="w3-select w3-border">
                                <option selected disabled>Printery</option>
                                <?php while ($rs = $prt->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $rs['printery_id'] ?>"><?php echo $rs['pname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-quarter">
                            <select name="category" class="w3-select w3-border">
                                <option disabled selected>Category</option>
                                <?php while ($rs = $cat->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $rs['category_id'] ?>"><?php echo $rs['ctitle'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-quarter">
                            <select name="series" class="w3-select w3-border">
                                <option disabled selected>Series</option>
                                <?php while ($rs = $ser->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $rs['series_id'] ?>"><?php echo $rs['sname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-container w3-center">
                            <button type="submit" name="searchBook" class="w3-button w3-black w3-round-large w3-large w3-margin">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w3-row">
                <div class="w3-container">
                    <div class="w3-col m4 w3-left w3-container w3-center" style="width: 100px">
                        <br>
                    </div>
                    <div class="w3-col m4 w3-right w3-container w3-center" style="width: 100px">
                        <br>
                    </div>
                    <div class="w3-rest">
                        <table class="w3-table-all w3-centered w3-hoverable table-bordered ">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th class="">ID</th>
                                    <th class="">Book Name</th>
                                    <th class="">Printery</th>
                                    <th class="">Quantity</th>
                                    <th class="">Price</th>
                                    <th class="">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rs = $book->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td class=""><?php echo $rs['book_id'] ?></td>
                                        <td class=""><?php echo $rs['bname'] ?></td>
                                        <td class=""><?php echo $rs['pname'] ?></td>
                                        <td class=""><?php echo $rs['bquantity'] ?></td>
                                        <td class=""><?php echo $rs['bprice'] ?></td>
                                        <td class="" style="width:25%; height: 50px;">
                                            <button type="button" data-id="<?php echo $rs['book_id'] ?>" class="btn btn-outline-success px-3 show_modal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-4">
                                    <h5 class="w3-right">Total Book</h5>
                                </div>
                                <div class="col-2">
                                    <h5 class="w3-center"><?php echo $count['count'] ?></h5>
                                </div>
                                <div class="col-3">
                                    <h5>Amount</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- quatity modal -->
    <div class="modal fade bd-example-modal-sm" id="order" role="dialog">
        <div class="w3-modal-content w3-animate-zoom w3-card-4" style="max-width:500px">
            <div class="modal-dialog modal-sm"></div>
            <div class="w3-conatiner w3-theme-d3">
                <p class="w3-xxxlarge w3-center w3-margin">Add Book</p>
            </div>
            <br>
            <div class="w3-conatiner">
                <div class="w3-container w3-center">
                    <label for="textInput" class="t">Quantity</label>
                    <input type="number" value="" min="1" id="bquantity" name="bquantity" class="form-control mb-4" placeholder="1">
                </div>
            </div>
            <div class="w3-container">
                <div class="w3-container w3-center w3-margin ">
                    <button type="submit" id="update_qty" class="btn btn-success">Confirm</button>
                    <button type="button" id="close" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.show_modal').click(function() {
            var id = $(this).data('id');
            $('#update_qty').data('id', id);
            $('#order').modal('show');
        })

        $('#close').click(function() {
            $('#order').modal('hide');
        })

        $('#update_qty').click(function() {
            var id = $(this).data('id');
            if (qty != 0) {
                window.location.href = "update_book_qty.php?bquantity=" + "&book_id=" + id;
            } else {
                alert("** Please enter the required amount. **")
            }
        })
    })
</script>
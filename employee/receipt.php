<?php
    session_start();
    include '../DB/connection.php';

    $emp_id = $_SESSION['emp_id'];
    $total = $_GET['btotal'];
    $cash = $_GET['bcash'];

    $date = date('Y-m-d');

    $th = mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
    $format = "H:i:s";
    $time = date($format,$th);
    
    $sql = "INSERT INTO bill (btotal, bdate, btime, bcash, emp_id) VALUES (?, ?, ?, ?, ?)";
    $insert = $pdo->prepare($sql);
    $insert->bindValue(1, $total, PDO::PARAM_INT);
    $insert->bindValue(2, $date, PDO::PARAM_STR);
    $insert->bindValue(3, $time, PDO::PARAM_STR);
    $insert->bindValue(4, $cash, PDO::PARAM_INT);
    $insert->bindValue(5, $emp_id, PDO::PARAM_INT);
    $insert->execute();

    $sql = "SELECT bill_id FROM bill ORDER BY bill_id DESC LIMIT 1";
    $result = $pdo->prepare($sql);
    $result->execute();

    $id = $result->fetch(PDO::FETCH_ASSOC);

    for($i = 0; $i < count($_GET['bookId']); $i++) {
        $sql = "INSERT INTO checkbill (bill_id, book_id, quantitycheck) VALUES (?, ?, ?)";
        $insertCheck = $pdo->prepare($sql);
        $insertCheck->bindValue(1, $id['bill_id'], PDO::PARAM_INT);
        $insertCheck->bindValue(2, $_GET['bookId'][$i], PDO::PARAM_INT);
        $insertCheck->bindValue(3, $_GET['bookQty'][$i], PDO::PARAM_INT);
        $insertCheck->execute();

        $sql = "UPDATE book 
        SET bquantity = (SELECT bquantity FROM book WHERE book_id = ?) - ?
        WHERE book_id = ?";
        $updateBook = $pdo->prepare($sql);
        $updateBook->bindValue(1, $_GET['bookId'][$i], PDO::PARAM_INT);
        $updateBook->bindValue(2, $_GET['bookQty'][$i], PDO::PARAM_INT);
        $updateBook->bindValue(3, $_GET['bookId'][$i], PDO::PARAM_INT);
        $updateBook->execute();
    }

    echo $id['bill_id'];
    exit;

?>
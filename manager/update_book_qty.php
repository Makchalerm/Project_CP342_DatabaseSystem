<?php 

    session_start();

    include '../DB/connection.php';

    $book_id = $_GET['book_id'];
    $quantity = $_GET['bquantity'];
    $date = date('Y-m-d');
    $th = mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
    $format = "H:i:s";
    $time = date($format,$th);

    $sql = "UPDATE book 
    SET bquantity = (SELECT bquantity FROM book WHERE book_id = $book_id) + ? 
    WHERE book_id = $book_id";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $quantity, PDO::PARAM_INT);
    $result->execute();

    $adsql = "INSERT INTO addbook(book_id, abquantity, abdate, abtime)
        VALUES (?, ?, ?, ?)";
    $result2 = $pdo->prepare($adsql);
    $result2->bindValue(1, $book_id, PDO::PARAM_INT);
    $result2->bindValue(2, $quantity, PDO::PARAM_INT);
    $result2->bindValue(3, $date, PDO::PARAM_STR);
    $result2->bindValue(4, $time, PDO::PARAM_STR);
    $result2->execute();

    header("Location: store.php");

?>
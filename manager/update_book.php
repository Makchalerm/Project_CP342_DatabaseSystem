<?php

    session_start();

    include '../DB/connection.php';

    $book_id = $_GET['book_id'];
    $book_name = trim($_GET['bname']);
    $book_price = $_GET['bprice'];
    $category_id = $_GET['category_id'];
    $series_id = $_GET['series_id'];

    $sql = "UPDATE book 
    SET series_id = ?, category_id = ?, bname = ?, bprice = ?
    WHERE book_id = ?";
    $update = $pdo->prepare($sql);
    $update->bindValue(1, $series_id, PDO::PARAM_INT);
    $update->bindValue(2, $category_id, PDO::PARAM_INT);
    $update->bindValue(3, $book_name, PDO::PARAM_STR);
    $update->bindValue(4, $book_price, PDO::PARAM_INT);
    $update->bindValue(5, $book_id, PDO::PARAM_INT);
    $update->execute();

    header("Location: store.php");

?>
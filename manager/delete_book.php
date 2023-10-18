<?php
    session_start();
    include '../DB/connection.php';

    $book_id = $_POST['book_id'];

    $sql = "UPDATE book 
    SET bquantity = 0
    WHERE book_id = ?";
    $deleted = $pdo->prepare($sql);
    $deleted->bindValue(1, $book_id, PDO::PARAM_INT);
    $deleted->execute();

    if($deleted) {
        echo 1;
    }else {
        echo 0;
    }
    
?>
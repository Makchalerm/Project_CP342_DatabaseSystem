<?php

    session_start();

    include '../DB/connection.php';

    $book_id = (int)$_POST['book_id'];
    $sql = "SELECT * FROM book WHERE book_id = $book_id";
    $result = $pdo->prepare($sql);
    $result->execute();

    $output = $result->fetch(PDO::FETCH_ASSOC);

    echo json_encode($output);

?>
<?php

    session_start();

    include '../DB/connection.php';

    $emp_id = $_POST['emp_id'];
    $firstname = $_POST['efirstname'];
    $lastname = $_POST['elastname'];
    $card_id = $_POST['ecard_id'];
    $address = $_POST['eaddress'];
    $tel = $_POST['etel'];
    $gender = $_POST['egender'];

    $sql = "UPDATE employee 
    SET efirstname = ?, elastname = ?, ecard_id = ?, eaddress = ?, etel = ?, egender = ?
    WHERE emp_id = $emp_id";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $firstname, PDO::PARAM_STR);
    $result->bindValue(2, $lastname, PDO::PARAM_STR);
    $result->bindValue(3, $card_id, PDO::PARAM_INT);
    $result->bindValue(4, $address, PDO::PARAM_STR);
    $result->bindValue(5, $tel, PDO::PARAM_STR);
    $result->bindValue(6, $gender, PDO::PARAM_STR);

    if($result->execute()) {
        echo 1;
    }else {
        echo -1;
    }
    exit;

?>
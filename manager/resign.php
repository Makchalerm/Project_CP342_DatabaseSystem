<?php

    session_start();

    include '../DB/connection.php';

    $id = (int)$_POST['id'];
    if($id == $_SESSION['emp_id']) {
        echo -1;
        exit;
    }

    $sql = "UPDATE employee
    SET status = ?
    WHERE emp_id = ?";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, true, PDO::PARAM_BOOL);
    $result->bindValue(2, $id, PDO::PARAM_INT);
    $result->execute();

    echo 1;
    exit;

?>
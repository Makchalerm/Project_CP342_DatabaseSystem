<?php

    session_start();

    include '../DB/connection.php';

    $emp_id = (int)$_POST['emp_id'];
    $sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
    $result = $pdo->prepare($sql);
    $result->execute();

    $output = $result->fetch(PDO::FETCH_ASSOC);

    echo json_encode($output);

?>
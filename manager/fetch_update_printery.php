<?php

    include '../DB/connection.php';

    $printery_id= $_POST['printery_id'];

    $sql = "SELECT * FROM printery WHERE printery_id = ?";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $printery_id, PDO::PARAM_INT);
    $result->execute();

    echo json_encode($result->fetch(PDO::FETCH_ASSOC));

?>
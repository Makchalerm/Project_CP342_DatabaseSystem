<?php

    include '../DB/connection.php';

    $printery_id = $_POST['printery_id'];
    $printery_name = $_POST['pname'];
    $paddress = $_POST['paddress'];
    $ptel = $_POST['ptel'];

    $sql = "UPDATE printery
    SET pname = ?, paddress = ?, ptel = ?
    WHERE printery_id = ?";
    $result = $pdo->prepare($sql);
    $result->bindValue(1, $printery_name, PDO::PARAM_STR);
    $result->bindValue(2, $paddress, PDO::PARAM_STR);
    $result->bindValue(3, $ptel, PDO::PARAM_STR);
    $result->bindValue(4, $printery_id, PDO::PARAM_INT);

    if($result->execute()) {
        echo 1;
    }else {
        echo -1;
    }

?>
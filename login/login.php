<?php

    session_start();

    include "../DB/connection.php";

    $ecard_id = 0;
    $message = "";

    if(isset($_POST['login'])) {
        if(trim($_POST['emppass']) == "") {
            $message = "Please Input ID CARD";
            header("Location: ../index.php?message=$message");
            exit;
        }

        $ecard_id = (int)(trim($_POST['emppass']));
        
        $sql = "SELECT * FROM employee WHERE  ecard_id = ? AND status = false";
        $result = $pdo->prepare($sql);
        $result->bindValue(1, $ecard_id, PDO::PARAM_INT);
        $isFound = $result->execute();

        if($result->rowCount() == 0) {
            $message = "ID CARD Incorrect";
            header("Location: ../index.php?message=$message");
        }else {
            $rs = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['emp_id'] = $rs['emp_id'];
            $_SESSION['ecard_id'] = $ecard_id;
            $_SESSION['efirstname'] = $rs['efirstname'];
            $_SESSION['elastname'] = $rs['elastname'];
            $_SESSION['eaddress'] = $rs['eaddress'];               
            $_SESSION['etel'] = $rs['etel'];
            $_SESSION['egender'] = $rs['egender'];
            $_SESSION['erole'] = $rs['erole'];
            $_SESSION['img_id'] = $rs['img_id'];
            if($_SESSION['erole'] == 'Manager') {
                header("Location: ../manager/home.php");
            }else if($_SESSION['erole'] == 'Employee'){
                header("Location: ../employee/home.php");
            }
        }
    }

?>
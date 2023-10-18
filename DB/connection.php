<?php

    try {
        $pdo = new PDO("pgsql:host=localhost;port=5433;dbname=dbproject;user=postgres;password=Sahaphab123");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        echo $e->getMessage();
    }
    

?>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');
//print_r($_POST);
    // Handles Update Query
    if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){
        
        $assetName = $_POST['assetName'];
        $assetType = $_POST['assetType'];
        $totalPurchased = $_POST['totalPurchased'];
        $assetIsActive = $_POST['assetIsActive'];
        $assigned = $_POST['assigned'];
        $id=$_POST['id'];



        $row = explode(', ', $_POST['row']);

        if(empty($assetName)){
            $assetName = $row[0];
        }
        if(empty($assetType)){
            $assetType = $row[1];
        }
        if(empty($totalPurchased)){
            $totalPurchased = $row[2];
        }

       
        $sql = 'UPDATE Asset_Tracking SET name=?, assetType=?, totalPurchased=?, isActive=?, assigned=? WHERE id=?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location:Asset_Tracking?error=1');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssisis", $assetName, $assetType, $totalPurchased, $assetIsActive, $assigned, $id);

        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        header('Location:Asset_Tracking?res=1');
        // comment
        exit();
    }



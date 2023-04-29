<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');

    // Handles Update Query
    if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){
        
        $assetName = $_POST['assetName'];
        $assetType = $_POST['assetType'];
        $totalPurchased = $_POST['totalPurchased'];
        $warranty = $_POST['assetWarranty'];
        $assigned = $_POST['assigned'];
        $id=$_POST['id'];



        $row = explode(', ', $_POST['row']);

        if(empty($assetName)){
            $assetName = $row[0][0];
        }
        if(empty($assetType)){
            $assetType = $row[0][1];
        }
        if(empty($totalPurchased)){
            $totalPurchased = $row[0][2];
        }
        if(empty($warranty)){
            $totalPurchased = $row[0][3];
        }
        if(empty($assigned)){
            $totalPurchased = $row[0][4];
        }

       
        $sql = 'UPDATE Asset_Tracking SET name=?, type=?, totalPurchased=?, warranty=?, assigned=? WHERE id=?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location:Asset_Tracking?error=1');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssisis", $assetName, $assetType, $totalPurchased, $warranty, $assigned, $id);

        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        header('Location:Asset_Tracking?res=none');
        // comment
        exit();
    }



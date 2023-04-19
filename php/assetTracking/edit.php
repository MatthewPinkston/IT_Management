<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');

    // Handles Update Query
    if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){
        
        $assetName = $_POST['assetName'];
        $assetType = $_POST['assetType'];
        $purchaseOrder = $_POST['purchaseOrder'];
        $assetStatus = $_POST['assetStatus'];
        $assigned = $_POST['assigned'];
        $id=$_POST['id'];



        $row = explode(', ', $_POST['row']);

        if(empty($assetName)){
            $assetName = $row[0];
        }
        if(empty($assetType)){
            $assetType = $row[1];
        }
        if(empty($purchaseOrder)){
            $purchaseOrder = $row[2];
        }

       
        $sql = 'UPDATE Asset_Tracking SET name=?, assetType=?, purchaseOrder=?, status=?, assigned=? WHERE id=?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location:Asset_Tracking?error=1');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssisis", $assetName, $assetType, $purchaseOrder, $assetStatus, $assigned, $id);

        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        header('Location:Asset_Tracking?res=1');
        // comment
        exit();
    }



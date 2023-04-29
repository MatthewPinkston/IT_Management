<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');

    // Handles Update Query
    if(isset($_POST['edit']) && $_POST['edit'] == 'edit'){
        
        $softwareName = $_POST['softwareName'];
        $softwareVersion = $_POST['softwareVersion'];
        $totalPurchased = $_POST['totalPurchased'];
        $mangedToInstall = $_POST['mangedToInstall'];
        $complianceStatus = $_POST['complianceStatus'];
        $networkInstallations = $_POST['networkInstallations'];
        $id=$_POST['id'];



        $row = explode(', ', $_POST['row']);

        if(empty($softwareName)){
            $softwareName = $row[0];
        }
        if(empty($softwareVersion)){
            $softwareVersion = $row[1];
        }
        if(empty($totalPurchased)){
            $totalPurchased = $row[2];
        }
        if(empty($mangedToInstall)){
            $mangedToInstall = $row[3];
        }
        if(empty($complianceStatus)){
            $complianceStatus = $row[4];
        }
        if(empty($networkInstallations)){
            $networkInstallations = $row[5];
        }

       
        $sql = 'UPDATE License_Tracking SET name=?, version=?, totalPurchased=?, managedInstallations=?, complianceStatus=?, networkInstallations=? WHERE id=?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: users?res=failure');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssis", $softwareName, $softwareVersion, $totalPurchased, $mangedToInstall, $complianceStatus, $networkInstallations, $id);

        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        header('Location: /License_Tracking?res=success');
        // comment
        exit();
    }



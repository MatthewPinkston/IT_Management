<?php
require 'vendor/autoload.php';
require_once($_SERVER['DOCUMENT_ROOT']."/php/authentication/register.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/authentication/authentication.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');
use Bcrypt\Bcrypt;
use Ramsey\Uuid\Uuid;

if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
    $softwareName = $_POST['softwareName'];
    $softwareVersion = $_POST['softwareVersion'];
    $totalPurchased = $_POST['totalPurchased'];
    $mangedToInstall = $_POST['mangedToInstall'];
    $complianceStatus = $_POST['complianceStatus'];
    $networkInstallations = $_POST['networkInstallations'];


    if(emptyInput([$softwareName, $softwareVersion, $totalPurchased])){
        header('Location: users?error=2');
        exit();
    }

    // if(idExists($conn, $email) !== false){
    //     header('Location: users?error=3');
    //     exit();
    // }

    // else{

        $id = Uuid::uuid4();
        $sql = "INSERT INTO License_Tracking(id, name, version, totalPurchased, managedInstallations, complianceStatus, networkInstallations) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        //	Check if statement fails
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: License_Tracking?error=4");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "sssssss", $id, $softwareName, $softwareVersion, $totalPurchased, $mangedToInstall, $complianceStatus, $networkInstallations);

        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt); 
            
        mysqli_close($conn);
        mysqli_stmt_close($stmt);
        header('Location: License_Tracking?res=2');
        exit();
    // }
}
<?php
require 'vendor/autoload.php';
require_once($_SERVER['DOCUMENT_ROOT']."/php/authentication/register.php");
require_once($_SERVER['DOCUMENT_ROOT']."/php/authentication/authentication.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');
use Bcrypt\Bcrypt;
use Ramsey\Uuid\Uuid;

//print_r($_POST);
if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
    $assetName = $_POST['assetName'];
    $assetType = $_POST['assetType'];
    $totalPurchased = $_POST['totalPurchased'];
    $warranty = $_POST['assetWarranty'];
    $assigned = $_POST['assigned'];


    if(emptyInput([$assetName, $assetType, $totalPurchased, $warranty])){
        header('Location: Asset_Tracking?error=2');
        exit();
    }

    // if(idExists($conn, $email) !== false){
    //     header('Location: users?error=3');
    //     exit();
    // }

    // else{

        $id = Uuid::uuid4();
        $sql = "INSERT INTO Asset_Tracking(id, name, type, totalPurchased,  warranty, assigned) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        //	Check if statement fails
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location:Asset_Tracking?error=4");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "sssisi", $id, $assetName, $assetType, $totalPurchased, $warranty, $assigned);

        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt); 
            
        mysqli_close($conn);
        mysqli_stmt_close($stmt);
        header('Location:Asset_Tracking?res=2');
        exit();
    // }
}
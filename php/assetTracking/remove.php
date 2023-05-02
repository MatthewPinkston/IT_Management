<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');
    if(isset($_POST['remove']) && $_POST['remove'] == 'remove'){
        $id = $_POST['id'];
        // print_r($_POST);
        $sql = 'DELETE FROM Asset_Tracking WHERE id=?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location:Asset_Tracking?res=failure');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header('Location:Asset_Tracking?res=success');
        exit();
    }
    
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/mysql/config.php');
    if(isset($_POST['remove']) && $_POST['remove'] == 'remove'){
        $id = $_POST['id'];
   
        $sql = 'DELETE FROM License_Tracking WHERE id=?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('Location: License_Tracking?error=1');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header('Location: /License_Tracking?error=n');
        exit();
    }
    
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/authentication/authentication.php');
    require_once($_SERVER['DOCUMENT_ROOT']."/php/authentication/register.php");
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/authentication/roles.php');
    require_once($_SERVER['DOCUMENT_ROOT']."/mysql/config.php");
    use Bcrypt\Bcrypt;

    $title = 'Profile';

    //verify user is logged in 
    if(!isLogged()){
        header('Location: login');
    }

    $error = null;

    if(isset($_POST['viewLicenseInfo']) && $_POST['viewLicenseInfo'] === 'Save'){
        
        $sql = "SELECT FROM License_Tracking SET name=?, version=?, totalPurchased=?, managedInstallations=?, networkInstallations=? WHERE id=?;";

        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $error = '1';
        }

        else{
            
            mysqli_stmt_bind_param($stmt, "ssssss", $_POST['name'], $_POST['version'], $_POST['totalPurchased'], $_POST['managedInstallations'], $_POST['networkInstallations'], $_POST['id']);

            mysqli_stmt_execute($stmt);

            $res = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

            $_GET['id']=$_POST['id'];

            $error = 'none';
        }
    }

    if(isset($_GET['id']) && $_GET['id'] !== ''){
        
            $sql = "SELECT * FROM License_Tracking WHERE id='".$_GET['id']."'";
            // echo $sql;exit;
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);

           
           

            
     
    }
    
    echo $_SESSION['TWIG']->render('/views/view_license.html', [
        'title' => $title, //Expected by the header
        'userName' => $_SESSION['current_user']['firstName'], //Expected for nav bar user's name display
        'userView' => checkPrivilege('view_users', $_SESSION['user_roles']), //Expected for nav bar to show (or not) the users table view
        'rolesView' => checkPrivilege('view_roles', $_SESSION['user_roles']),
        'appName' => $_ENV['APP_NAME'], //Expected for nav bar to show name of the application
        'modules' => $_SERVER['MODULE_PATHS'], //Expected side navbar

        'currentLicense' => $row,
        'error' => $error,
    ]);

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

    if(isset($_POST['changeLicenseInfo']) && $_POST['changeLicenseInfo'] === 'Save'){
        
 Team1_Staging_Adnan
        $sql = "UPDATE License_Tracking SET name=?, version=?, quantityPurchased=?, quantityUsed=? WHERE itemNumber=?;";

        $sql = "UPDATE License_Tracking SET name=?, version=?, quantityPurchased=?, quantityUsed=? WHERE id=?;";
 Team1_Staging

        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $error = '1';
        }

        else{
            
 Team1_Staging_Adnan
            mysqli_stmt_bind_param($stmt, "sssss", $_POST['name'], $_POST['version'], $_POST['quantityPurchased'], $_POST['quantityUsed'], $_POST['itemNumber']);

            mysqli_stmt_bind_param($stmt, "sssss", $_POST['name'], $_POST['version'], $_POST['quantityPurchased'], $_POST['quantityUsed'], $_POST['id']);
 Team1_Staging

            mysqli_stmt_execute($stmt);

            $res = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

            $_GET['itemNumber']=$_POST['itemNumber'];

            $error = 'none';
        }
    }

    if(isset($_GET['itemNumber']) && $_GET['itemNumber'] !== ''){
        
 Team1_Staging_Adnan
            $sql = "SELECT * FROM License_Tracking WHERE `itemNumber`='".$_GET['itemNumber']."'";
            // echo $sql;exit;
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);

           
           


        $sql = "SELECT * FROM License_Tracking WHERE id='".$_GET['id']."'";
        // echo $sql;exit;
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

           
 Team1_Staging
            
     
    }
    //var_dump($row);exit;
    echo $_SESSION['TWIG']->render('/views/edit_license.html', [
        'title' => $title, //Expected by the header
        'userName' => $_SESSION['current_user']['firstName'], //Expected for nav bar user's name display
        'userView' => checkPrivilege('view_users', $_SESSION['user_roles']), //Expected for nav bar to show (or not) the users table view
        'rolesView' => checkPrivilege('view_roles', $_SESSION['user_roles']),
        'appName' => $_ENV['APP_NAME'], //Expected for nav bar to show name of the application
        'modules' => $_SERVER['MODULE_PATHS'], //Expected side navbar
        
        'currentLicense' => ['id'=>isset($_GET['id'])?$_GET['id']:''],
        'error' => $error,
    ]);
?>
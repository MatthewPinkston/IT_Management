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

    if(isset($_POST['addLicenseInfo']) && $_POST['addLicenseInfo'] === 'Save'){
        $form = array(
            'name' => $_POST['name'],
            'version' => $_POST['version'],
            'totalPurchased' => $_POST['totalPurchased'],
            'managedInstallations' => $_POST['managedInstallations'],
            'networkInstallations' => $_POST['networkInstallations']
        );

        if(emptyInput($form)){
            $error = '1';
        }

        else{


        }

        $sql = "INSERT INTO License_Tracking(id, name, version, totalPurchased, managedInstallations, networkInstallations) VALUES(?, ?, ?, ?, ?,?);";

        $stmt = mysqli_prepare($conn, $sql);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $error = '1';
        }

        else{

            $myuid = uniqid('', true);
            $myuid = substr($myuid, 0, 8) . '-' . substr($myuid, 8, 4) . '-' . substr($myuid, 12, 4) . '-' . substr($myuid, 16, 4) . '-' . substr($myuid, 20);
            // mysqli_stmt_bind_param($stmt, "sssssss", $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['question1'], $_POST['question2'], $_POST['question3'], $_SESSION['current_user']['id']);
            mysqli_stmt_bind_param($stmt, "ssssss", $myuid, $_POST['name'], $_POST['version'], $_POST['totalPurchased'], $_POST['managedInstallations'], $_POST['networkInstallations']);

            mysqli_stmt_execute($stmt);

            $res = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

           
            $error = 'none';
        }
    }

    
    
    echo $_SESSION['TWIG']->render('/views/add_license.html', [
        'title' => $title, //Expected by the header
        'userName' => $_SESSION['current_user']['firstName'], //Expected for nav bar user's name display
        'userView' => checkPrivilege('view_users', $_SESSION['user_roles']), //Expected for nav bar to show (or not) the users table view
        'rolesView' => checkPrivilege('view_roles', $_SESSION['user_roles']),
        'appName' => $_ENV['APP_NAME'], //Expected for nav bar to show name of the application
        'modules' => $_SERVER['MODULE_PATHS'], //Expected side navbar

        // 'currentLicense' => $row,
        'error' => $error,
    ]);

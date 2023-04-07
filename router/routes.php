<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/router/router.php");
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/authentication/roles.php');
    require_once($_SERVER['DOCUMENT_ROOT']."/modules/appRoutes.php");
    //  GET
    get('/', './controllers/home.php');
    get('/login', './controllers/login.php');
    get('/register', './controllers/register.php');
    get('/main', './controllers/mainTemplateExample.php');
    get('/twoCol', './controllers/twoColumnExample.php');
    get('/edit-lic', './controllers/edit_license.php');
    get('/add-lic', './controllers/add_license.php');
    get('/delete-lic', './controllers/delete_license.php');
    get('/view-lic', './controllers/view_license.php');
    get('/add-asset', './controllers/add_asset.php');
 Team1_Staging_Adnan
    get('/delete-asset', './controllers/delete_asset.php');
=======
    get('/edit-asset', './controllers/edit_asset.php');
 Team1_Staging

    if(isset($_SESSION['user_roles']) && checkPrivilege('view_users', $_SESSION['user_roles'])){
        get('/users', './controllers/users.php');
    }
    if(isset($_SESSION['user_roles']) && checkPrivilege('view_roles', $_SESSION['user_roles'])){
        get('/roles', './controllers/roles.php');
        post('/roles', './controllers/roles.php');
    }


    get('/profile', './controllers/profile.php');

    get('/t', './test.php');
    get('/t2', './test2.php');
    get('/t3', './controllers/test3.php');

    //  POST
    post('/login', './controllers/login.php');
    post('/logout', './controllers/login.php');
    post('/register', './controllers/register.php');
    post('/forgotPassword', './controllers/forgotPassword.php');


    post('/edit', './php/users/edit.php');
    post('/remove', './php/users/remove.php');
    post('/add', './php/users/add.php');

    post('/profile', './controllers/profile.php');

    post('/edit-lic', './controllers/edit_license.php');
    post('/add-lic', './controllers/add_license.php');
    post('/delete-lic', './controllers/delete_license.php');
    post('/view-lic', './controllers/view_license.php');
 Team1_Staging_Will
    get('/add-asset', './controllers/view_asset.php');
    get('/view-asset', './controllers/view_asset.php');
=======

    post('/add-asset', './controllers/add_asset.php');
 Team1_Staging_Adnan
    post('/delete-asset', './controllers/delete_asset.php');
=======
    post('/edit-asset', './controllers/edit_asset.php');
 Team1_Staging
 Team1_Staging

    // For GET or POST
    // The 404.php which is inside the views folder will be called
    // The 404.php has access to $_GET and $_POST
    any('/404','./controllers/404.php');


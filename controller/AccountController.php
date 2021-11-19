<?php
require_once("../config/config.php");
require_once("../model/SignupModel.php");
require_once("../model/LoginModel.php");

if (
    isset(
        $_POST['pseudo'], //Lory
        $_POST['email'],
        $_POST['password'],
        $_POST['comfirm_password'],
        $_POST['user_type'],
        $_POST['accepted']
    )
) {
    $isValid = checkSignUp(
        $_POST['pseudo'],
        $_POST['email'],
        $_POST['password'],
        $_POST['comfirm_password'],
        $_POST['user_type'],
        $_POST['accepted']
    );
    var_dump($isValid);
    die();

    if ($isValid['exist']) {
        header("Location:" . $domaine . "/vues/account/signup.php");
        return;
    }

    header("Location:" . $domaine . "/vues/account/successfully.php");
    return;
}


if (isset($_POST['email'], $_POST['password'])) {
    $isValid = checkLogin(
        $_POST['email'],
        $_POST['password']
    );

    if (!$isValid['exist']) {
        header("Location:" . $domaine . "/index.php");
        return;
    }

    header("Location:" . $domaine . "/vues/account/login.php?error=" . $isValid['message']);
    return;
}

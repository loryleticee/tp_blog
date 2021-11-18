<?php
include_once("../config/config.php");
include_once("../model/SignupModel.php");

if (
    isset(
        $_POST['pseudo'],
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

    if (!$isValid['exist']) {
        header("Location:". $domaine ."/vues/account/signup.php");
    }
    
    header("Location:". $domaine ."/successfly.html");
}
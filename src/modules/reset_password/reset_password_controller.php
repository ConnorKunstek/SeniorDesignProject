<?php
/**
 * Created by PhpStorm.
 * User: ConnorKunstek
 * Date: 12/2/18
 * Time: 6:25 PM
 */
require_once("reset_password_model.php");
require_once("../../lib/EmailServices.php");


if(isset($_POST['email'])){

    sanitized();

    missing();

    $uid = checkEmail();

    $temp = changePassword($uid);

    sendVerification($temp);

    success("Password sent to given email");
}else{
    header("Location: reset_password_view.php");
    exit();
}

function sendVerification($password){
    $email = new EmailServices($_POST['email']);
    $email->sendNotification("Your temporary password is $password. Please use it to sign in and then change it from Profile");
}

function changePassword($uid){

    $temp = rand(100001, 999999);

    if(change($uid, $temp)){
        return $temp;
    }else{
        error("Error: Could not reset password");
    }
}


function checkEmail(){

    $return = check($_POST['email']);

    if(!empty($return[0])) {
        return $return[0];
    }else{
        error("Error: Email '$return[0]' was not found");
    }
}

function sanitized() {

    $array = array(

        'email' => FILTER_SANITIZE_EMAIL
    );

    if(!filter_input_array(INPUT_POST, $array)){
        error("Error: Invalid entry.");
    }
}

function missing(){
    if(empty($_POST['email'])){
        error("Error: Please enter your correct email");
    }
}

/**
 * throws error with give message
 * @param  $message, error message to be displayed
 * @return none
 */

function error($message){
    $_SESSION['errorMessage'] = $message;
    $_SESSION['edit'] = true;
    header("Location: reset_password_view.php");
    exit();
}


/**
 * got back to view with success message
 * @param  $message, message to be displayed
 * @return none
 */

function success($message){
    $_SESSION['success'] = $message;
    $_SESSION['edit'] = false;
    header("Location: ../../../index.php");
    exit();
}


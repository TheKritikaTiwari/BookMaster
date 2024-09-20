<?php
session_start();
include("data_class.php");

$login_name=$_GET['name'];
$login_email=$_GET['mail'];
$login_password=$_GET['password'];
$type= $_GET['type'];

if($login_name==null || $login_email==null || $login_password==null){
    $namemsg="";
    $emailmsg="";
    $pasdmsg="";
    if($login_name==null){
        $namemsg="This is a required field.";
    } elseif($login_email==null){
        $emailmsg="This is a required field.";
    } elseif($login_password==null){
        $pasdmsg=" This is a required field.";
    }

    header("Location:signup.php?adnamemsg=$namemsg&ademailmsg=$emailmsg&adpasdmsg=$pasdmsg");
}

elseif($login_name!=null && $login_email!=null && $login_password!=null){
    $obj=new data();
    $obj->setconnection();
    $obj->userSignup($login_name,$login_email,$login_password,$type);

}

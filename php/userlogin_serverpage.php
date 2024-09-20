<?php
session_start();
include("data_class.php");

$login_email=$_GET['mail'];
$login_password=$_GET['password'];

if($login_email==null || $login_password==null){

    $emailmsg="";
    $pasdmsg="";
    if($login_email==null){
        $emailmsg="This is a required field.";
    } elseif($login_password==null){
        $pasdmsg=" This is a required field.";
    }

    header("Location:index.php?ademailmsg=$emailmsg&adpasdmsg=$pasdmsg");
}

elseif($login_email!=null && $login_password!=null){
    $obj=new data();
    $obj->setconnection();
    $obj->userLogin($login_email,$login_password);
}
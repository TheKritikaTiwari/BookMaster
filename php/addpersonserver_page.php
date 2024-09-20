<?php

include("data_class.php");

$addname=$_POST['name'];
$addpass= $_POST['password'];
$addemail= $_POST['email'];
$type= $_POST['type'];

$obj=new data();
$obj->setconnection();
$obj->addnewuser($addname,$addpass,$addemail,$type);

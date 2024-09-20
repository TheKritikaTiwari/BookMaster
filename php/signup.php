<?php
    session_start();
    if(isset($_SESSION['name'])){
        $msg = $_SESSION['name'];
        echo "<script>
                alert('$msg');
            </script>";
    }
    session_destroy();
?>

<?php

$namemsg="";
$emailmsg="";
$pasdmsg="";
$msg="";

$adnamemsg="";
$ademailmsg="";
$adpasdmsg="";

if(!empty($_REQUEST['adnamemsg'])){
    $adnamemsg=$_REQUEST['adnamemsg'];
}

if(!empty($_REQUEST['ademailmsg'])){
    $ademailmsg=$_REQUEST['ademailmsg'];
}

if(!empty($_REQUEST['adpasdmsg'])){
    $adpasdmsg=$_REQUEST['adpasdmsg'];
}

if(!empty($_REQUEST['namemsg'])){
    $namemsg=$_REQUEST['namemsg'];
}

if(!empty($_REQUEST['emailmsg'])){
    $emailmsg=$_REQUEST['emailmsg'];
}

if(!empty($_REQUEST['pasdmsg'])){
    $pasdmsg=$_REQUEST['pasdmsg'];
}

if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookMaster</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <style>
        body{
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            overflow-y: hidden;
        }
        .whole-form{
            padding-top: 20px;
        }
        .form{
            height: auto;
            padding-top: 1px;
            padding-bottom: 20px;
            width: 400px;
            margin: auto;
            box-shadow: rgba(50, 50, 105, 0.15) 0px 2px 5px 0px, #FF8A08 0px 1px 1px 0px;
        }
        .form input[type="text"], input[type="email"], input[type="password"], input[type="file"]{
            border-radius: 50px;
            padding-top: 2px;
        }
        .form select{
            border-radius: 50px;
        }

        ::placeholder{
            font-size: 13px;
        }
        .form label{
            font-size: 14px;
            margin-left: 5px;
        }
        .login{
            width: 200px;
            background-color: #F97300;
            color: #fff;
            border: none;
            padding: 10px 30px;
            margin: auto;
            border-radius: 50px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px,
            rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            display: block; 
            text-align: center;
        }
        #submit-btn, #signup-btn {
            background-color: #F97300;
            width:150px;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        #submit-btn:hover {
            background-color: #e66400;
            transform: scale(1.05); 
        }
        img{
            display: block;
            margin: auto;
            width: 130px;
            height: 130px;
        }
    </style>
</head>
<body>
    <section style="padding-top: 40px;">
        <div style="padding-bottom: 10px;">
            <img src="../images/profile.png" alt="">
        </div>
        <div style="padding-bottom: 1px;">
            <Button class="login text-center">User Sign Up</Button>
        </div>
        <div class="container  col-12 col-md-4 whole-form">
            <form action="signup2.php" method="GET" enctype="multipart/form-data">
                <div class="form pl-3 pr-3">    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name <sup><span style="color:red;">*</span></sup></label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Name">
                        <span style="color:red;"><?php echo $adnamemsg?></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Id <sup><span style="color:red;">*</span></sup></label>
                        <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email Id">
                        <span style="color:red;"><?php echo $ademailmsg?></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password <sup><span style="color:red;">*</span></sup> <span style="color:red; font-size:10px;">( Enter Password Max 8 Digit )</span></label>
                        <input type="password" name="password" maxlength="8" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="*********">
                        <span style="color:red;"><?php echo $adpasdmsg?></span>
                    </div>
                    <div class="form-group">
                        <label for="typw">User Type<sup><span style="color:red;">*</span></sup></label>
                        <select class="form-control" name="type" >
                            <option value="Student">Student</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-block text-center">
                                <input type="submit" name="ok" value="Submit" id="submit-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

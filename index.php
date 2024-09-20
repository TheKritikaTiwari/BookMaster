
<?php
    session_start();
    echo "<div id='msgAlert' class='alert alert-primary' style='text-align:center;'>
            For a better experience, please use a desktop or laptop.
          </div>";
    if(isset($_SESSION['name'])){
        $msg = $_SESSION['name'];
        echo "<script>
                alert('$msg');
            </script>";
    }
    session_destroy();
?>

<?php
 $emailmsg="";
 $pasdmsg="";
 $msg="";

 $ademailmsg="";
 $adpasdmsg="";


 if(!empty($_REQUEST['ademailmsg'])){
    $ademailmsg=$_REQUEST['ademailmsg'];
 }

 if(!empty($_REQUEST['adpasdmsg'])){
    $adpasdmsg=$_REQUEST['adpasdmsg'];
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
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{
            overflow-x: hidden;
            overflow-y: hidden;
        }
        .imglogo{
            margin: auto;
            margin-bottom: 10px;
            width: 900px;
            height: 250px;
        }
        #input-fill{
            width:400px;
        }
        #sub-btn{
            width:150px;
            background-color:#F97300; 
            color:#fff; 
            border:none; 
            padding:6px 30px; 
            border-radius:50px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        #sign-btn{
            display: flex;
        }
        .container{
            padding-top: 10px;
            padding-left: 50px;
            display: flex;
        }
        .login{
            width: 200px;
            background-color: #F97300;
            color: #fff;
            border: none;
            padding: 6px 30px;
            margin: 10px auto; 
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
        #signup-btn:hover {
            background-color: #ffa500; 
            transform: translateY(-3px); 
        }
    </style>
</head>
<body>
    <section>
        <!-- TOP IMAGE -->
        <div class="row"><img class="imglogo" src="Images/BookMaster.png"/></div>

        <!-- Login -->
        <div class="login-container container mt-3 mb-5">
            <!-- User Login -->
            <div class="whole-form">
                <div class="form pl-3 pr-3">
                    <div class="sign-btn" style="height: 275px;">
                        <form action="studentlogin_serverpage.php" method="GET" enctype="multipart/form-data">
                            <Button class="login text-center">User Login</Button>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Id <sup><span style="color:red;">*</span></sup></label>
                                <input type="email" name="mail" class="form-control" id="input-fill" aria-describedby="emailHelp" placeholder="Enter Your Email Id" autocomplete="off">
                                <span style="color:red;"><?php echo $ademailmsg?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password <sup><span style="color:red;">*</span></sup> <span style="color:red; font-size:10px;">( Enter Password Max 8 Digit )</span></label>
                                <input type="password" name="password" maxlength="8" class="form-control" id="input-fill" aria-describedby="emailHelp" placeholder="*********" autocomplete="new-password">
                                <span style="color:red;"><?php echo $adpasdmsg?></span>
                            </div>
                            <div class="row btn-container">
                                <div class="col-6 text-center">
                                    <input type="submit" name="ok" value="Submit" id="submit-btn">
                                </div>
                        </form>
                                <div class="col-6 text-center">
                                    <form action="signup.php" method="post" enctype="multipart/form-data">
                                        <input type="submit" name="ok" value="Signup" id="signup-btn">
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Admin Login -->
            <div class="whole-form">
                <div class="form pl-3 pr-3">
                    <form action="adminlogin_serverpage.php" method="GET" enctype="multipart/form-data">
                        <Button class="login text-center">Admin Login</Button>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Id <sup><span style="color:red;">*</span></sup></label>
                            <input type="email" name="mail" class="form-control" id="input-fill" aria-describedby="emailHelp" placeholder="Enter Your Email Id" autocomplete="off">
                            <span style="color:red;"><?php echo $ademailmsg?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password <sup><span style="color:red;">*</span></sup> <span style="color:red; font-size:10px;">(Enter Password Max 8 Digit)</span></label>
                            <input type="password" name="password" maxlength="8" class="form-control" id="input-fill" aria-describedby="emailHelp" placeholder="*********" autocomplete="new-password">
                            <span style="color:red;"><?php echo $adpasdmsg?></span>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-block text-center">
                                    <input type="submit" name="ok" value="Submit" id="submit-btn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </section>
    <script>
        setTimeout(function() {
        var alertBox = document.getElementById('msgAlert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
        }, 2500);
    </script>
</body>
</html>
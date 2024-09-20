<?php

ob_start();
session_start();
$userloginid=$_SESSION["userid"] = $_GET['userlogid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BookMaster</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body{
            overflow-x: hidden;
        }
        .imglogo{
            margin: auto;
            margin-bottom: 10px;
            width: 900px;
            height: 250px;
        }
        .acclogo{
            width: 120px;
            height: 120px;
            text-align: left;
        }
        .innerdiv{
            text-align: center;
            margin: 0px 50px 50px 50px;    
        }
        .leftinnerdiv{
            float: left;
            display: flex;
            flex-direction: column; 
            width: 23%;
        }
        .leftbutton{
            width: 200px;
            background-color:#F97300; 
            color:#fff; 
            border:none; 
            padding:6px 30px; 
            margin-bottom: 10px;
            border-radius:50px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, 
            rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        .add{
            float: right;
            display: flex;
            flex-direction: column; 
            width: 75%;
        }
        .select-box{
            width: 200px;
            padding-top: 2px;
            padding-bottom: 2px;
        }
        .rightbutton{
            width: 200px;
            background-color:#F97300; 
            color:#fff; 
            border:none; 
            padding:6px 30px; 
            margin-bottom: 10px;
            border-radius:50px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, 
            rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        .form-myaccount{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap:0px;
        }
        .acc-logo{
            width: 35%;
        }
        .acc-detail{
            width: 65%;
        }
        .viewbutton{
            width: 200px;
            background-color:#F97300; 
            color:#fff; 
            border:none; 
            padding:6px 30px; 
            margin-bottom: 10px;
            border-radius:50px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, 
            rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        .form-group{
            margin:2px;
        }
        .sidebar-btn:hover {
            background: linear-gradient(45deg, #F97300, #d9a941);
            transform: translateY(-3px);
        }
        .fun-fact {
            height: 120px;
            background-color: #f9f9f9;
            border-left: 5px solid #F97300;
            border-right: 5px solid #F97300;
            padding: 2px 10px 10px 10px;
            margin-top: 5px;
            font-style: italic;
        }
        .fun-fact h3 {
            margin: 0;
            color: #F97300;
        }
        .arrow {
            font-size: 24px;
            color: #F97300;
            cursor: pointer;
            margin-left: 10px;
            vertical-align: middle;
            padding-top:5px;
        }
        .arrow:hover {
            color: #ff7f50;
        }
    </style>  
</head>
<body>
    <?php
        include("data_class.php");

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            if ($msg == "book_not_available") {
                echo "<div id='msgAlert' class='alert alert-danger' style='text-align:center;'>The book is not available for request.</div>";
            } elseif ($msg == "fail") {
                echo "<div id='msgAlert' class='alert alert-danger' style='text-align:center;'>Request failed. Please try again.</div>";
            } elseif ($msg == "done") {
                echo "<div id='msgAlert' class='alert alert-success' style='text-align:center;'>Request successful!</div>";
            }
        }

    ?>   
    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="../Images/BookMaster.png"/></div>

            <!-- Fun Fact Section -->
            <div class="fun-fact">
                <h3 style="color:#F97300;">Did You Know?</h3>
                <p style="font-style:italic; padding-top:10px;" id="fun-fact-text">Libraries existed as early as 2600 BC in ancient Sumer.</p>
                <span class="arrow" onclick="nextFunFact()">&#x2192;</span>
            </div>

            <!-- LEFT PANNEL -->
            <div class="leftinnerdiv" style="padding-top:30px;">
                <Button class="leftbutton">Welcome</Button>
                <Button class="leftbutton sidebar-btn" onclick="openpart('myaccount')">My Account</Button>
                <Button class="leftbutton sidebar-btn" onclick="openpart('bookrequest')">Request Book</Button>
                <Button class="leftbutton sidebar-btn" onclick="openpart('bookreport')">Book Report</Button>
                <Button class="leftbutton sidebar-btn" style="color: white;" onclick="window.location.href='index.php';">Logout</Button>
            </div>

            <!-- My Account -->
            <div class="rightinnerdiv">
                <div id="myaccount" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo ""; }?>">
                <Button class="rightbutton text-center">My Account</Button>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->userdetail($userloginid);
                        $recordset=$u->userdetail($userloginid); 
                        $id = $name = $email = $type = '';                      
                        foreach($recordset as $row){                        
                            $id= $row[0];
                            $name= " ".$row[1];
                            $email= $row[2];
                            $pass= $row[3];
                            $type= $row[4];
                        }
                        $bookCount = $u->getIssuedBookCount($id);
                    ?>
                    <div class="form form-myaccount" style="text-align: left; width: 77%; padding-left: 20px;">
                        <div class="acc-logo" style="text-align: left;">
                            <img class="acclogo" src="../Images/profile.png"/>
                        </div>
                        <div class="acc-detail" style="text-align: left;">
                            <p style="color:black; font-weight: bold; font-size: 28px; margin-bottom:2px;">Welcome <?php echo $name ?></p>
                            <p style="color:black; font-size: 20px;margin-bottom: 5px;">Email Id: &nbsp<?php echo $email ?></p>
                            <p style="color:black; font-size: 20px;margin-bottom: 5px;">Books Issued: &nbsp<?php echo $bookCount ?></p>
                            <p style="color:black; font-size: 18px; font-style: italic; "><?php echo $type ?></p>
                        </div>
                    </div>
                </div>    
            </div>

            <!-- Request Book -->
            <div class="rightinnerdiv">
                <div id="bookrequest" class="innerright portion" style="display: none">
                    <button class="rightbutton">Request Book</button>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset=$u->getbookissue();  
                        $table="<table class='form add' style='font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;width: 77%;'><tr><th style='
                        padding: 20px 20px 10px 20px;'>Book Name</th><th style='padding: 20px 20px 10px 20px;'>Author</th><th style='padding: 20px 20px 10px 20px;'>Branch</th>
                        <th style='padding: 20px 10px 10px 10px;'>Price </th><th style='padding: 20px 10px 10px 10px;'>Available</th><th style='padding: 20px 10px 10px 10px;'>Request Book</th></tr>";
                        foreach($recordset as $row){
                            $bookava = ($row[8] < 0) ? 0 : $row[8];
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            $table.="<td>$row[1]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[5]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$bookava</td>";
                            $table.="<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";
                            $table.="</tr>";
                        }
                        $table.="</table>";
                        echo $table;
                    ?>
                </div>
            </div>

            <!-- Book Report -->
            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="display: none">
                    <button class="rightbutton">Book Report</button>
                    <?php
                        $userloginid=$_SESSION["userid"] = $_GET['userlogid'];
                        $u=new data;
                        $u->setconnection();
                        $u->getissuebook($userloginid);
                        $recordset=$u->getissuebook($userloginid);
                        $table="<table class='form add' style='font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;width: 77%;'><tr><th style='
                        padding: 20px 40px 10px 40px;'>Name</th><th style='padding: 20px 40px 10px 40px;'>Book Name</th><th style='padding: 20px 40px 10px 40px;'>Issue Date</th>
                        <th style='padding: 20px 40px 10px 40px;'>Return Date</th><th style='padding: 20px 40px 10px 40px;'>Return</th></tr>";
                        foreach($recordset as $row){
                            $table.="<tr>";
                           "<td>$row[0]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[4]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="<td><a href='user_service_dashboard.php?returnid=$row[0]&userlogid=$userloginid'><button type='button' class='btn btn-primary'>Return</button></a></td>";
                            $table.="</tr>";
                        }
                        $table.="</table>";                    
                        echo $table;
                    ?>
                </div>
            </div>
            <div class="rightinnerdiv">   
                <div id="return" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];} else {echo "display:none"; }?>">
                    <Button class="greenbtn" >Return Book</Button>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->returnbook($returnid);
                        $recordset=$u->returnbook($returnid);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
        var alertBox = document.getElementById('msgAlert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
        }, 2500); 

        function openpart(portion){
            var i;
            var x=document.getElementsByClassName("portion");
            for(i=0; i<x.length;i++){
                x[i].style.display =  "none";
            }
            document.getElementById(portion).style.display = "block";
        }
        
        // Next Fun Fact
            const funFacts = [
                "Libraries existed as early as 2600 BC in ancient Sumer.",
                "The largest library in the world is the Library of Congress.",
                "The first known library catalog was made in 2000 BC.",
                "Public libraries were first opened in the U.S. in 1833.",
                "The word 'library' comes from the Latin 'liber,' meaning 'book.'"
            ];
            let currentFactIndex = 0;
            function nextFunFact() {
                currentFactIndex = (currentFactIndex + 1) % funFacts.length;
                document.getElementById('fun-fact-text').textContent = funFacts[currentFactIndex];
            }
    </script>
</body>
</html>

<?php
ob_end_flush();
?>
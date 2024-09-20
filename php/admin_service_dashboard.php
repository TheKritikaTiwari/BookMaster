<?php
    session_start();
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
        .innerdiv{
            text-align: center;
            margin: 0px 50px 50px 50px;
            
        }
        .leftinnerdiv{
            float: left;
            display: flex;
            flex-direction: column; 
            width: 25%;
        }
        .leftbutton{
            width: 220px;
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
        #label-id{
            padding-right: 10px; 
            font-size: 16px;
            font-weight: bold;
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
        .form{
            display: flex;
            flex-direction: column;
            
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
        #submit-btn{
            background-color: #F97300; 
            width:150px;
            color: white;
            padding: 7px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        #submit-btn:hover {
            background-color: #e66400; 
            transform: scale(1.05); 
        }
    </style>  
</head>
<body>
    <?php
        include("data_class.php");
        $msg="";

        if(!empty($_REQUEST['msg'])){
            $msg=$_REQUEST['msg'];
        }

        if($msg=="done"){
            echo "<div id='msgAlert' class='alert alert-success' role='alert'>Sucssefully Done</div>";
        }
        elseif($msg=="fail"){
            echo "<div id='msgAlert' class='alert alert-danger' role='alert'>Fail</div>";
        } 
        elseif ($msg == "cannot_delete_user") {
            echo "<div id='msgAlert' class='alert alert-danger' role='alert'>Cannot delete user until all issued books are returned.</div>";
        }
        elseif ($msg == "cannot_delete_book") {
            echo "<div id='msgAlert' class='alert alert-danger' role='alert'>This book can't be deleted because it is currently issued to a user.</div>";
        }

    ?>
    <div class="container">
        <div class="innerdiv">
            <!-- TOP IMAGE -->
                <div class="row"><img class="imglogo" src="../Images/BookMaster.png"/></div>

            <!-- LEFT PANNEL -->
                <div class="leftinnerdiv" style="padding-top: 20px;">
                    <Button class="leftbutton">Admin</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('addbook')">Add New Book</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('bookreport')">View Book Details</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('bookrequests')">View Book Requests</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('addperson')">Add New User</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('studentreport')">View User Details</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('issuebook')">Issue Book</Button>
                    <Button class="leftbutton sidebar-btn" onclick="openpart('issuebookreport')">Issued Books Details</Button>
                    <Button class="leftbutton sidebar-btn" style="color: white;" onclick="window.location.href='index.php';">Logout</Button>
                </div>

            <!-- RIGHT PANNEL -->

                <!-- ADD NEW BOOK -->
                <div class="rightinnerdiv" style="padding-top: 20px;">
                    <div id="addbook" class="innerright portion" style="<?php if(!empty($_REQUEST['viewed'])){ echo "display:none";} else {echo ""; }?>">
                        <Button class="rightbutton text-center">Add New Book</Button>
                        <form action="addnewbook_server.php" method="post" enctype="multipart/form-data">
                        <div class="form add">
                            <div class="form-group">
                                <label id="label-id">Book Name:</label>
                                <input type="text"  name="bookname" >
                            </div>
                            <div class="form-group">
                                <label id="label-id">Details:</label>
                                <input type="text" name="bookdetail" >
                            </div>
                            <div class="form-group">
                                <label id="label-id">Author:</label>
                                <input type="text" name="bookauthor" >
                            </div>
                            <div class="form-group">
                                <label id="label-id">Publication:</label>
                                <input type="text" name="bookpub" >
                            </div>
                            <div class="form-group">
                                <label id="label-id" for="typw">Branch:</label>
                                <select name="branch" >
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Computer Engineering">Computer Engineering</option>
                                        <option value="Business Administration">Business Administration</option>
                                        <option value="Cybersecurity">Cybersecurity</option>
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="Chemistry">Chemistry</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="label-id">Price:</label>
                                <input type="text" name="bookprice" >
                            </div>
                            <div class="form-group">
                                <label id="label-id">Quantity:</label>
                                <input type="text" name="bookquantity" >
                            </div>
                            <div>
                                <input type="submit" name="ok" value="Submit" id="submit-btn">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- BOOK REPORT -->
                <div class="rightinnerdiv">
                    <div id="bookreport" class="innerright portion" style="display: none">
                        <button class="rightbutton">Book Details</button>
                        <?php
                            $u=new data;
                            $u->setconnection();
                            $u->getbook();
                            $recordset=$u->getbook();
                            $table="<table class='form' style='font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;width: 75%;'><tr><th style='
                            padding: 20px 30px 10px 20px;'>Book Name</th><th style='padding: 20px 30px 10px 30px;'>Book Author</th><th style='padding: 20px 20px 10px 20px;'>Price</th>
                            <th style='padding: 20px 20px 10px 20px;'>Qnt</th><th style='padding: 20px 20px 10px 20px;'>Available</th>
                            <th style='padding: 20px 20px 10px 20px;'>Rent</th><th style='padding: 20px 40px 10px 40px;'>Delete</th></tr>";
                            foreach($recordset as $row){
                                $bookava = ($row[8] < 0) ? 0 : $row[8];
                                $table.="<tr>";
                               "<td>$row[0]</td>";
                                $table.="<td>$row[1]</td>";
                                $table.="<td>$row[3]</td>";
                                $table.="<td>$row[6]</td>";
                                $table.="<td>$row[7]</td>";
                                $table.="<td>$bookava</td>";
                                $table.="<td>$row[9]</td>";
                                $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'><button type='button' class='btn btn-primary'>Delete</button></a></td>";
                                $table.="</tr>";
                            }
                            $table.="</table>";                
                            echo $table;
                        ?>
                    </div>
                </div>

                <!-- BOOK REQUEST & APPROVE -->
                <div class="rightinnerdiv">
                    <div id="bookrequests" class="innerright portion" style="display: none">
                        <Button class="rightbutton">Book Requests</Button>
                        <?php
                            $u=new data;
                            $u->setconnection();
                            $u->requestbookdata();
                            $recordset=$u->requestbookdata();
                            $table="<table class='form add' style='font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;width: 75%;'><tr><th style='
                            padding: 20px 30px 10px 50px;'>Person Name</th><th style='padding: 20px 30px 10px 30px;'>Person Type</th><th style='padding: 20px 30px 10px 30px;'>Book Name</th>
                            <th style='padding: 20px 30px 10px 30px;'>Days </th><th style='padding: 20px 40px 10px 30px;'>Approve</th></tr>";
                            foreach($recordset as $row){
                                $table.="<tr>";
                                "<td>$row[0]</td>";
                                "<td>$row[1]</td>";
                                "<td>$row[2]</td>";
                                $table.="<td>$row[3]</td>";
                                $table.="<td>$row[4]</td>";
                                $table.="<td>$row[5]</td>";
                                $table.="<td>$row[6]</td>";
                                $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved</button></a></td>";
                                $table.="</tr>";
                            }
                            $table.="</table>";
                            echo $table;
                        ?>
                    </div>
                </div>

                <!-- ADD PERSON -->
                <div class="rightinnerdiv">
                    <div id="addperson" class="innerright portion" style="display:none">
                        <Button class="rightbutton text-center">Add New User</Button>
                        <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                            <div class="form add">                        
                                <div class="form-group">
                                    <label id="label-id">Name:</label>
                                    <input type="text" name="name" >
                                </div>
                                <div class="form-group">
                                    <label id="label-id">Password:</label>
                                    <input type="password" name="password" autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label id="label-id">Email:</label>
                                    <input type="email" name="email" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label id="label-id" for="typw">User type:</label>
                                    <select name="type" >
                                        <option value="Student">Student</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Administrator">Administrator</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="submit" name="ok" value="Submit" id="submit-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 

                <!-- STUDENT REPORT -->
                <div class="rightinnerdiv">
                    <div id="studentreport" class="innerright portion" style="display:none">
                        <Button class="rightbutton text-center">User Details</Button>
                        <?php
                            $u=new data;
                            $u->setconnection();
                            $u->userdata();
                            $recordset=$u->userdata();                                
                            $table="<table class='form' style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 75%;padding: 20px 10px 20px 10px;'>
                            <tr><th style='padding-left: 40px;padding-right: 40px;'>Name</th><th style='padding-left: 50px;padding-right: 50px;'>Email</th><th style='padding-left: 30px;padding-right: 30px;'>Type</th><th style='padding-left: 20px;padding-right: 20px;'>Issued Books</th><th style='padding-left: 35px;padding-right: 35px;'>Delete</th></tr>";
                            foreach($recordset as $row){
                                $id = $row[0];
                                $bookCount = $u->getIssuedBookCount($id);
                                $table.="<tr>";
                                "<td>$row[0]</td>";
                                $table.="<td>$row[1]</td>";
                                $table.="<td>$row[2]</td>";
                                $table.="<td>$row[4]</td>";
                                $table.="<td>$bookCount</td>";
                                $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'><button type='button' class='btn btn-primary'>Delete</button></a></td>";
                                $table.="</tr>";
                            }
                            $table.="</table>";                    
                            echo $table;
                        ?>
                    </div>
                </div>

                <!-- ISSUE BOOK -->
                <div class="rightinnerdiv">
                    <div id="issuebook" class="innerright portion" style="display:none">
                        <Button class="rightbutton text-center">Issue Book</Button>
                        <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                            <div class="form add">                        
                                <div class="form-group">    
                                    <label id="label-id" for="book">Choose Book:</label>
                                    <select name="book" class="select-box">
                                        <?php
                                            $u=new data;
                                            $u->setconnection();
                                            $u->getbookissue();
                                            $recordset=$u->getbookissue();
                                            foreach($recordset as $row){
                                                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                                            }            
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="label-id" for="Select Student">Select User:</label>
                                    <select name="userselect" class="select-box" >
                                        <?php
                                            $u=new data;
                                            $u->setconnection();
                                            $u->userdata();
                                            $recordset=$u->userdata();
                                            foreach($recordset as $row){
                                            $id= $row[0];
                                                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                                            }            
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="label-id">Days:</label>
                                    <input style="border-radius: 10px;" type="number" name="days"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" id="submit-btn"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ISSUE BOOK RECORD -->
                <div class="rightinnerdiv">
                    <div id="issuebookreport" class="innerright portion" style="display:none">
                        <Button class="rightbutton text-center" style="width: 210px;">Issued Books Details</Button>
                        <?php
                        $u=new data;
                        $u->setconnection();
                        $u->issuereport();
                        $recordset=$u->issuereport();
                        $table="<table class='form' style='font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;width: 75%;padding: 15px;'><tr><th style='
                        padding: 10px 30px;'>User Name</th><th style='padding: 15px 20px;'>Book Name</th><th style='padding: 15px 20px;'>User Type</th><th style='padding: 15px 20px;'>Days </th>
                        <th style='padding: 15px 20px;'>Issue Date</th><th style='padding: 15px 20px;'>Return Date</th></tr>";
                                
                        foreach($recordset as $row){
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[4]</td>";
                            $table.="<td>$row[5]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="</tr>";
                        }
                        $table.="</table>";
                        echo $table;
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
        function openbook(viewid) {
            var x = document.getElementsByClassName("portion");
            for (var i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById("bookdetail").style.display = "block";
        }
    </script>
</body>
</html>
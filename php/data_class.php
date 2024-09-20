<?php
include("db.php");

class data extends db{

    private $name;
    private $password;
    private $email;
    private $type;
    private $bookname;
    private $bookdetail;
    private $bookauthor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returndate;

    // USER SIGNIN
        function userSignup($name,$email,$password,$type){
            $this->name=$name;
            $this->email=$email;
            $this->password=$password;
            $this->type=$type;
            $q="INSERT INTO userdata(id,name,email,password,type)VALUES('','$name','$email','$password','$type')";
            if($this->connection->exec($q)){
                header("Location:index.php?msg=done");
            }
            else{
                header("Location:signup2.php?msg=Register Fail");
            }
        }

    //USER LOGIN
        function userLogin($t1, $t2){
            $q = "select * from userdata where email='$t1' and password='$t2'";
            $recordSet = $this -> connection->query($q);
            $result = $recordSet -> rowCount();
            if($result > 0){
                foreach($recordSet -> fetchAll() as $row){
                    $logid = $row['id'];
                     $_SESSION['adminid'] = $logid;
                    header("location:user_service_dashboard.php?userlogid=$logid");
                }
            }
            elseif($result <= 0){
                header("location:index.php?msg=Invalid Credentials");
            }
        }

    // MY ACCOUNT
        function userdetail($id){
            $q="SELECT * FROM userdata where id ='$id'";
            $data=$this->connection->query($q);
            return $data;
        }
        function getIssuedBookCount($userId) {
            $sql = "SELECT COUNT(*) FROM issuebook WHERE userid = :userId"; 
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);  
            $stmt->execute();
            $bookCount = $stmt->fetchColumn();
            return $bookCount;
        }

    // REQUEST BOOK
    function requestbook($userid, $bookid) {
        $q = "SELECT * FROM book WHERE id='$bookid'";
        $recordSetss = $this->connection->query($q);
        $bookDetails = $recordSetss->fetch();

        if ($bookDetails['bookava'] <= 0) {
            header("Location:user_service_dashboard.php?userlogid=$userid&msg=book_not_available");
            return; 
        }

        $q = "SELECT * FROM userdata WHERE id='$userid'";
        $recordSet = $this->connection->query($q);
        $userDetails = $recordSet->fetch();
        $username = $userDetails['name'];
        $usertype = $userDetails['type'];
        $bookname = $bookDetails['bookname'];

        $days = ($usertype == "Student") ? 7 : 21;

        $q = "INSERT INTO requestbook (id, userid, bookid, username, usertype, bookname, issuedays) 
            VALUES ('', '$userid', '$bookid', '$username', '$usertype', '$bookname', '$days')";
        if ($this->connection->exec($q)) {
            header("Location:user_service_dashboard.php?userlogid=$userid&msg=done");
        } else {
            header("Location:user_service_dashboard.php?msg=fail");
        }
    }
    
    

    // RETURN BOOK
        function returnbook($id){
            $fine="";
            $bookava="";
            $issuebook="";
            $bookrentel="";
            $q="SELECT * FROM issuebook where id='$id'";
            $recordSet=$this->connection->query($q);
            foreach($recordSet->fetchAll() as $row) {
                $userid=$row['userid'];
                $issuebook=$row['issuebook'];
                $fine=$row['fine'];
            }
            if($fine==0){
            $q="SELECT * FROM book where bookname='$issuebook'";
            $recordSet=$this->connection->query($q);   
            foreach($recordSet->fetchAll() as $row) {
                $bookava=$row['bookava']+1;
                $bookrentel=$row['bookrent']-1;
            }
            $q="UPDATE book SET bookava='$bookava', bookrent='$bookrentel' where bookname='$issuebook'";
            $this->connection->exec($q);
            $q="DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
            if($this->connection->exec($q)){
                header("Location:user_service_dashboard.php?userlogid=$userid");
             }
         
            }
        }

    // ADMIN LOGIN
        function adminLogin($t1, $t2){
            $q = "select * from admin where email='$t1' and password='$t2'";
            $recordSet = $this -> connection->query($q);
            $result = $recordSet -> rowCount();
            if($result > 0){
                foreach($recordSet -> fetchAll() as $row){
                    $logid = $row['id'];
                     $_SESSION['adminid'] = $logid;
                    header("location:admin_service_dashboard.php?logid=$logid");
                }
            }
            elseif($result <= 0){
                header("location:index.php?msg=Invalid Credentials");
            }
        }

    // ADD NEW BOOK
        function addbook($bookname,$bookdetail,$bookauthor,$bookpub,$branch,$bookprice,$bookquantity){
            $this->bookname = $bookname;
            $this->bookdetail = $bookdetail;
            $this->bookauthor = $bookauthor;
            $this->bookpub = $bookpub;
            $this->branch = $branch;
            $this->bookprice = $bookprice;
            $this->bookquantity = $bookquantity;
            $q="INSERT INTO book (id,bookname,bookdetail,bookauthor,bookpub,branch,bookprice,bookquantity,bookava,bookrent)VALUES('','$bookname','$bookdetail','$bookauthor','$bookpub','$branch','$bookprice','$bookquantity','$bookquantity',0)";
            if($this->connection->exec($q)) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
        }

    // BOOK REPORT
        function getbook() {
            $q="SELECT * FROM book ";
            $data=$this->connection->query($q);
            return $data;
        }
        function getbookdetail($id){
            $q="SELECT * FROM book where id ='$id'";
            $data=$this->connection->query($q);
            return $data;
        }
        function deletebook($id){
            try {
                $q = "DELETE from book where id='$id'";
                $this->connection->exec($q);
                header("Location:admin_service_dashboard.php?msg=done");
            } catch (PDOException $e) {
               header("Location:admin_service_dashboard.php?msg=cannot_delete_book");
            }
        }

    // BOOK REQUEST $ APPROVE
        function requestbookdata(){
            $q="SELECT * FROM requestbook ";
            $data=$this->connection->query($q);
            return $data;
        }
        function issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$redid){
            $this->book= $book;
            $this->userselect=$userselect;
            $this->days=$days;
            $this->getdate=$getdate;
            $this->returnDate=$returnDate;
            $q="SELECT * FROM book where bookname='$book'";
            $recordSetss=$this->connection->query($q);
            $q="SELECT * FROM userdata where name='$userselect'";
            $recordSet=$this->connection->query($q);
            $result=$recordSet->rowCount();
            if ($result > 0) {
                foreach($recordSet->fetchAll() as $row) {
                    $issueid=$row['id'];
                    $issuetype=$row['type'];
                }
                foreach($recordSetss->fetchAll() as $row) {
                    $bookid=$row['id'];
                    $bookname=$row['bookname'];
                    $newbookava=$row['bookava']-1;
                    $newbookrent=$row['bookrent']+1;
                }
                $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
                if($this->connection->exec($q)){
                    $q="INSERT INTO issuebook (userid, bookid, issuename, issuebook, issuetype, issuedays, issuedate, issuereturn, fine) VALUES ('$issueid', '$bookid', '$userselect', '$book', '$issuetype', '$days', '$getdate', '$returnDate', '0')";
                    if($this->connection->exec($q)) {
                        $q="DELETE from requestbook where id='$redid'";
                        $this->connection->exec($q);
                        header("Location:admin_service_dashboard.php?msg=done");
                    }
                    else {
                        header("Location:admin_service_dashboard.php?msg=fail");
                    }
                }
                else{
                    header("Location:admin_service_dashboard.php?msg=fail");
                }
            }
            else {
                header("location: index.php?msg=Invalid Credentials");
            }
        }

    // ADD NEW USER
        function addnewuser($name,$password,$email,$type){
            $this->name=$name;
            $this->password=$password;
            $this->email=$email;
            $this->type=$type;
            $q="INSERT INTO userdata(id,name,email,password,type)VALUES('','$name','$email','$password','$type')";
            if($this->connection->exec($q)){
                header("Location:admin_service_dashboard.php?msg=done");
            }
            else{
                header("Location:admin_service_dashboard.php?msg=Register Fail");
            }
        }

    // STUDENT REPORT
        function userdata() {
            $q="SELECT * FROM userdata ";
            $data=$this->connection->query($q);
            return $data;
        }
        function delteuserdata($id){
            try {
                $q = "DELETE from userdata where id='$id'";
                $this->connection->exec($q);
                header("Location:admin_service_dashboard.php?msg=done");
            } catch (PDOException $e) {
                header("Location:admin_service_dashboard.php?msg=cannot_delete_user");
            }
        }

    // ISSUE BOOK
        function getbookissue(){
            $q="SELECT * FROM book where bookava !=0 ";
            $data=$this->connection->query($q);
            return $data;
        }
        function issuebook($book, $userselect, $days, $getdate, $returnDate) {
            $q = "SELECT * FROM book WHERE bookname='$book'";
            $recordSetss = $this->connection->query($q);
        
            $q = "SELECT * FROM userdata WHERE name='$userselect'";
            $recordSet = $this->connection->query($q);
            $result = $recordSet->rowCount();
        
            if ($result > 0) {
                $row = $recordSet->fetch();
                $issueid = $row['id'];  
                $issuetype = $row['type'];  
                
                $row = $recordSetss->fetch();
                $bookid = $row['id'];  
                $bookname = $row['bookname'];
                $newbookava = $row['bookava'] - 1;
                $newbookrent = $row['bookrent'] + 1;
                
                $q = "UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' WHERE id='$bookid'";
                
                if ($this->connection->exec($q)) {
                    $q = "INSERT INTO issuebook (userid, bookid, issuename, issuebook, issuetype, issuedays, issuedate, issuereturn, fine) 
                          VALUES ('$issueid', '$bookid', '$userselect', '$book', '$issuetype', '$days', '$getdate', '$returnDate', '0')";
                    
                    if ($this->connection->exec($q)) {
                        header("Location: admin_service_dashboard.php?msg=done");
                    } else {
                        header("Location: admin_service_dashboard.php?msg=fail");
                    }
                } else {
                    header("Location: admin_service_dashboard.php?msg=fail");
                }
            } else {
                header("Location: index.php?msg=Invalid Credentials");
            }
        }
        
        function getissuebook($userloginid) {
            $newfine="";
            $issuereturn="";
            $q="SELECT * FROM issuebook where userid='$userloginid'";
            $recordSetss=$this->connection->query($q);

            foreach($recordSetss->fetchAll() as $row) {
                $issuereturn=$row['issuereturn'];
                $fine=$row['fine'];
                $newfine= $fine;
            }
            $getdate= date("d/m/Y");
            if($issuereturn<$getdate){
                $q="UPDATE issuebook SET fine='$newfine' where userid='$userloginid'";
                if($this->connection->exec($q)) {
                    $q="SELECT * FROM issuebook where userid='$userloginid' ";
                    $data=$this->connection->query($q);
                    return $data;
                }
                else{
                    $q="SELECT * FROM issuebook where userid='$userloginid' ";
                    $data=$this->connection->query($q);
                    return $data;  
                }
            }
            else{
                $q="SELECT * FROM issuebook where userid='$userloginid'";
                $data=$this->connection->query($q);
                return $data;
            }
        }

    // ISSUE BOOK RECORD
        function issuereport(){
            $q="SELECT * FROM issuebook";
            $data=$this->connection->query($q);
            return $data;
        }
}   

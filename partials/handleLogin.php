<?php

$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
            include '_dbconnect.php';
            $email=$_POST["loginEmail"];
            $pass=$_POST["loginPass"];
        
                $sql="Select * from rec_users where user_email='$email'";
                $result=mysqli_query($conn,$sql);
                $numRows = mysqli_num_rows($result);
                echo $numRows;
                if($numRows==1){
                  $row=mysqli_fetch_assoc($result);
                    if(password_verify($pass, $row['user_pass']))
                    {
                      session_start();
                      $_SESSION['loggedin']="true";
                      $_SESSION['sno']=$row['sno'];
                      $_SESSION['useremail']=$email;
                    }
                    header("location: /REC Forum/index.php");
                  }
                  header("location: /REC Forum/index.php");
}
?>
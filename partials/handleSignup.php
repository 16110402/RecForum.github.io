<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    //check whether username is exist or not
    $existSql="SELECT * FROM `rec_users` WHERE user_email='$user_email'"; //"select * from `users` where user_email=$user_email";
    $result=mysqli_query($conn,$existSql);
    $numRows=mysqli_num_rows($result);
    echo $numRows;
    if($numRows>0)
    {
        $showError="Email is already exists";
    }
    else
    {
        if($pass==$cpass)
        {
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `rec_users` (`user_email`, `user_pass`, `timestamp`)
             VALUES ('$user_email', '$hash', CURRENT_TIMESTAMP)";
            $result=mysqli_query($conn,$sql) ;
            if($result)
            {
                $showAlert="true";
                header("Location: /REC Forum/index.php?signupsucces=true");
                exit();
            }
        }
        else
        {
            $showError="Password do not matched";
        }
    }
    header("Location: /REC Forum/index.php?signupsucces=false&error=$showError");
}

?>
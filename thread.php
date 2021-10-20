<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>welcome to !Discuss - coding Forum</title>
  <style>
    /* .text-center{
      border:4px solid;
      border-radius:10px;
      border-color: lightblue;
      width: 340px;
      text-align: center;
      margin-left: 450px;
      background-color:blueviolet;
      color: white;
    } */
    #fh{
      background-image: url("img/SignUp_Image");
      margin:0;
      padding: 0;
      background-repeat: no-repeat;
      font-family: sans-serif;
      width:100%;
      /* position: absolute; */
      z-index:-1;
      background-size: cover;
      color: white;
    }
    .clean{
      top: 10px;
      font-size: 2.5vh;
      /* text-align: center; */
      /* line-height: 1.5em; */
      background-color:orange;
      width:100%;
      color: blue;
      /* height:220px; */
      border:2px solid;
      border-radius:10px;
      margin:20px auto 20px auto;
      box-shadow:0px 0px 20px red;
    }
    #fh{
         text-align: center;
    }
    #post{
      color:black
    }
    #usert{
      border:2px solid;
      border-radius:10px;
      max-width: 80vh;
      text-align: center;
      margin-left: 50px;
      background-color:lightskyblue;
      color: white;
      /* margin:20px auto 20px auto; */
      box-shadow:0px 0px 20px blue;
      color: brown;
}
  </style>
</head>

<body>

  <?php include 'partials/_header.php'; ?>
  <?php include 'partials/_dbconnect.php'; ?>
<div id="fh">
  <?php
  $id=$_GET['threadid'];
  $sql = "SELECT * FROM `rec_threads` WHERE thread_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result))
  {
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT `user_email` FROM `rec_users` where sno='$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $posted_by=$row2['user_email'];
  }
  ?>

<?php
  $showAlert=false;
  $method=$_SERVER['REQUEST_METHOD'];
  if($method=='POST')
  {
    $th_title=NULL;
    $th_desc=NULL;
    $comment=$_POST['comment'];
    $comment=str_replace("<","&lt",$comment);
    $comment=str_replace(">","&gt",$comment);
    $sno=$_POST['sno'];
    $sql = "INSERT INTO `rec_comments` (`comment_content`, `thread_id`, `comment_by`,
     `comment_time`) VALUES ('$comment', '$id', '$sno', CURRENT_TIMESTAMP);";
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert)
    {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success Submitted!</strong> Your comment has been submitted ! Please wait for community support.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  }
?>

  <div class="container">

  <div class="jumbotron">
    <div id="uh">
  <h1 class="display-4"><?php echo $title; ?> forums</h1>
  <p class="lead"><?php echo $desc; ?></p>
  </div>
  <hr class="my-4">
  <div class="clean">
  <ul type="disc">
  <li>This is perr to peer forum for sharing knowledge with each other.</li>
  <li>No Spam / Advertising / Self-promote in the forums. ...</li>
  <li>Do not post copyright-infringing material. ...</li>
  <li>Do not post “offensive” posts, links or images. ...</li>
  <li>Do not cross post questions. ...</li>
  <li>Do not PM users asking for help. ...</li>
  <li>Remain respectful of other members at all times</li>
 </ul>
</div>
  <!-- <p class="lead">
    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
  </p> -->
  <p id="post">Posted by: <b>  <?php echo $posted_by; ?> </b></p>
 </div>
</div>
</div>
 <hr>
 <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true")
{
echo '<div class="container">
<h2 class="py-2">Post a Comment</h2>
<form action="'. $_SERVER["REQUEST_URI"] .'" method="post">
<div class="mb-3">
<div class="mb-3">
<label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
<input type="hidden" name="sno" value="' .$_SESSION["sno"]. '">
</div>
<button type="submit" class="btn btn-success">Post Comment</button>
</form>';
}
else
{
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Need Login Again!</strong> You are not logged in.Please login for Post a comments.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

  <div class="container" id="ques">
  <h1 class="container text-center" style="color: white;background-color:blueviolet;text-align: center;border:4px solid;border-radius:10px;border-color: lightblue;max-width: 50vh;">Discussion</h1>
  <hr>
   <?php
  $id=$_GET['threadid'];
  $sql = "SELECT * FROM `rec_comments` WHERE thread_id=$id";
  $result = mysqli_query($conn, $sql);
  $noResult=true;
  while ($row = mysqli_fetch_assoc($result))
  {
    $noResult=false;
    $id=$row['comment_id'];
    $content=$row['comment_content'];
    $comment_time=$row['comment_time'];
    $comment_by=$row['comment_by'];
    $sql2="SELECT user_email FROM `rec_users` where sno=$comment_by";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);

  echo '<div class="media my-3">
       <img class="mr-3 mx-5" src="img/user_default.png" width="34px" alt="Generic placeholder image">
     <div class="media-body" id="usert">
     <p class="font-weight-bold my-0">'.  $row2['user_email'] .' at '. $comment_time .'</p>
         <h5 class="mt-0">' . $id . '' . $content . '</h5>
        
      </div>
   </div>';
  }
  if($noResult){
    echo '<div class="jumbotron jumbotron-fluid"> 
    <div class="container">
      <h1 class="display-4">No Results Founds</h1>
      <p class="lead">Be the first person to ask the Question</p>
    </div>
  </div>';
  }
   ?> 

  <?php include 'partials/_footer.php'; ?>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>
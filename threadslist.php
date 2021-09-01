<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Welcome to Rec Sonbhadra - coding Forum</title>
<style>
  .clean{
      top: 10px;
      font-size: 20px;
      /* text-align: center; */
      line-height: 1.5em;
      background-color:lightblue;
      width:700px;
      height:220px;
      border:2px solid;
      border-radius:10px;
      margin:20px auto 20px auto;
      box-shadow:0px 0px 20px red;
    }
    .dt{
      background-color:lightsteelblue;
      width: 100%;
      height: 100%;
    }
    .clean1{
      top: 10px;
      font-size: 20px;
      /* text-align: center; */
      line-height: 1.5em;
      background-color:orange;
      width:1080px;
      height:180px;
      border:2px solid;
      border-radius:10px;
      margin:20px auto 20px auto;
      box-shadow:0px 0px 20px red;
    }
    body{
    margin:0;
    padding: 0;
    background: url(img/LaptopImage.jpg);
    background-repeat: no-repeat;
    font-family: sans-serif;
    width:100%;
    position: absolute;
    z-index:-1;
    background-size: cover;
}
.text-center{
      border:2px solid;
      border-radius:10px;
      width: 400px;
      text-align: center;
      margin-left: 450px;
      background-color:blueviolet;
      color: white;
}
#usert{
  border:2px solid;
      border-radius:10px;
      width: 400px;
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

  <?php
  $id=$_GET['catid'];
  $sql = " SELECT * FROM `rec_categories` WHERE category_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result))
  {
    $catname=$row['category_name'];
    $catdesc=$row['category_description'];
  }
  ?>

<?php
  $showAlert=false;
  $method=$_SERVER['REQUEST_METHOD'];
  if($method=='POST')
  {
    $th_title=NULL;
    $th_desc=NULL;
    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];
    $th_title=str_replace("<","&lt",$th_title);
    $th_title=str_replace(">","&gt",$th_title);

    $th_desc=str_replace("<","&lt",$th_desc);
    $th_desc=str_replace(">","&gt",$th_desc);
    $sno=$_POST['sno'];
    if($th_title!=NULL && $th_desc!=NULL)
    {
    $sql = "INSERT INTO `rec_threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '1', '$sno', CURRENT_TIMESTAMP);";
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert)
    {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success Submitted!</strong> Your threas has been submitted ! Please wait for community support.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
  }
?>
  <div class="container my-4">

  <div class="jumbotron">
<div class="clean1">
  <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
  <p class="lead"><?php echo $catdesc; ?></p>
  <hr class="my-4">
</div>
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
  <p class="lead">
    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>
  </div>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true")
{
echo '<div class="container">
    <h1 class="py-2" style="color:white;">Start a Discussion</h1>
    <form action="'.$_SERVER["REQUEST_URI"] . '" method="post">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" style="color:white;">Problem Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text text-muted">Keep your title as short.</div>
    </div>
  <div class="mb-3">
   <label for="exampleFormControlTextarea1" class="form-label" style="color:white;">Elaborate Your Concern</label>
   <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>
  <input type="hidden" name="sno" value="' .$_SESSION["sno"]. '">
  <button type="submit" class="btn btn-success">Submit</button>
</form>
</div>';
}
else
{
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Need Login!</strong> You are not logged in.Please login for discussion.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
<div class="dt my-2">
  <h1 class="text-center">Browse Questions</h1>
<?php
  $id=$_GET['catid'];
  $sql = "SELECT * FROM `rec_threads` WHERE thread_cat_id=$id";
  $result = mysqli_query($conn, $sql);
  $noResult=true;

  while ($row = mysqli_fetch_assoc($result))
  {
    $noResult=false;
    $id=$row['thread_id'];
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];
    $thread_time=$row['timestamp'];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT user_email FROM `rec_users` where sno=$thread_user_id";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    // $row2['user_email'];

  echo '<div class="media my-3">
       <img class="mr-3 mx-5" src="img/user_default.png" width="34px" alt="Generic placeholder image">
     <div class="media-body my-2" id="usert">
     <p class="font-weight-bold my-0">'.  $row2['user_email'] .' at '. $thread_time .'</p>
         <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
         ' . $desc . '
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
</div>


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
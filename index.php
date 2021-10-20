<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Welcome to !REC Forum - coding Forum</title>  
  <!-- <style>
    .text-center{
      border:4px solid;
      border-radius:10px;
      border-color: lightblue;
      width: 340px;
      text-align: center;
      margin-left: 450px;
      background-color:blueviolet;
      color: white;
    }
  </style> -->
</head>

<body>

  <?php include 'partials/_header.php'; ?>
  <?php include 'partials/_dbconnect.php'; ?>

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/rec_2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/rec_3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/rec_1.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container my-3">
    <!-- <div class="text-center my-3"> -->
    <h2 class="container text-center" style="color: white;background-color:blueviolet;text-align: center;border:4px solid;border-radius:10px;border-color: lightblue;width: 340px;">Coding - Categories</h2>
    <!-- </div> -->
      <div class="row my-3">

        <!-- Fetch all the categories -->
        <?php
        $sql = "SELECT * FROM `rec_categories`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          // echo $row['category_id'];
          // echo $row['category_name'];
          $id=$row['category_id'];
          $cat=$row['category_name'];
          // echo $id;
          $desc=$row['category_description'];
          echo '<div class="col-md-4">
  <div class="card" style="width: 18rem;">
  <img src="img/'. $id . '.jpg"  class="card-img-top" alt="...">  
  <div class="card-body">
    <h5 class="card-title"><a href="threadslist.php?catid=' . $id .'">'. $cat . '</a></h5>
    <p class="card-text">'. substr($desc,0,90) . '...</p>
    <a href="threadslist.php?catid=' . $id .'" class="btn btn-primary">View Threads</a>
  </div>
</div>
  </div>';
        }
        ?>
    
      </div>
  </div>
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
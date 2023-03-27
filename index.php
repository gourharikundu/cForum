<?php include "partials/_dbconnect.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cForum-Coding Discussion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/forum/images/car-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/forum/images/car-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/forum/images/car-3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-3">
      <h1 align="center"><b>cForum-Browse categories</b></h1>
        <div class="row my-3">
            <?php
              $sql="SELECT * FROM `category`";
              $result=mysqli_query($conn, $sql);
              while($row=mysqli_fetch_assoc($result)){
                echo '
                <div class="col-sm-4 my-2">
                  <div class="card">
                    <img src="/forum/images/card-'.$row["cat_id"].'.jpg" class="card-img-top px-2 py-2" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-dark" href="/forum/threadlist.php?catid='.$row["cat_id"].'">'.$row["cat_title"].'</a></h5>
                        <p class="card-text">'.substr($row["cat_description"],0,90).'...</p>
                        <a href="/forum/threadlist.php?catid='.$row["cat_id"].'" class="btn btn-primary">Explore</a>
                    </div>
                  </div>
                </div>
                ';
              }
            ?>
        </div>
    </div>
    <?php include "partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
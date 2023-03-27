<?php
include "_signupModal.php";
include "_loginModal.php";
session_start();
  echo'
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/forum">cForum</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/forum/">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Top Categories</a>
            <ul class="dropdown-menu">';
                $sql="SELECT * FROM `category` limit 4";
                $result=mysqli_query($conn, $sql);
                while($row=mysqli_fetch_assoc($result)){
                    echo '<li><a class="dropdown-item" href="/forum/threadlist.php?catid='.$row["cat_id"].'">'.$row["cat_title"].'</a></li>';
                }
          
       echo' 
       </ul>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/forum/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/contactus.php">Contact US</a>
        </li>
      </ul>

      <form class="d-flex" role="search" action="/forum/search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
        <button type="submit" class="btn btn-success">Search</button>
      </form>';
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
        echo'<p class="text-light my-0 mx-2">Welcome '.$_SESSION["username"].'</p>
             <a class="btn btn-outline-success mx-2" href="/forum/partials/_logout.php" >Logout</a>
            ';
      }
      else{
        echo'<button class="btn btn-outline-success mx-2" type="submit"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
             <button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">SignUP</button>
            ';
      }
      echo'
    </div>
  </div>
</nav>';

?>
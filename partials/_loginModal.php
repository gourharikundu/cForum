<?php
    $showError=false;
    require "partials/_dbconnect.php";
    if(isset($_POST["loginUname"])){
        $uname=$_POST["loginUname"];
        $password=$_POST["password"];
        $sql="SELECT * FROM `users` WHERE `username` = '$uname'";
        $result=mysqli_query($conn, $sql);
        $numExistRow=mysqli_num_rows($result);
        //echo var_dump($result);
        if($numExistRow==1){
            while($row=mysqli_fetch_assoc($result)){
                $id=$row["user_id"];
                if(password_verify($password,$row['password'])){
                    session_start();
                    $_SESSION['username']=$uname;
                    $_SESSION['loggedin']=true;
                    $_SESSION['loggedin_user_id']=$id;
                    
                    //echo $_SESSION['username'];
                    header("location: /forum/index.php?loggedin=true");
                    exit();
                }
                
            }
        }
        header("location: /forum/index.php?loggedin=false");
  }
?>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Login to cForum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Username</label>
                        <input type="text" class="form-control" id="uname" name="loginUname" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <center><button type="submit" class="btn btn-primary">Submit</button></center>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
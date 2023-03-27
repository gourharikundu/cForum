<?php
    require "_dbconnect.php";
    if(isset($_POST["signupUname"])){
        $uname=$_POST["signupUname"];
        $password=$_POST["password"];
        $cpassword=$_POST["cpassword"];

        $sql="SELECT * FROM `users` WHERE `users`.`username` = '$uname'";
        $result=mysqli_query($conn, $sql);
        $numExistRow=mysqli_num_rows($result);
        if($numExistRow>0){
            $showError="Username already exists !";
        }
        else{
            if($password==$cpassword){
                $hsh=password_hash($password,PASSWORD_BCRYPT);
                $sql="INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$uname', '$hsh', current_timestamp());";
                $result=mysqli_query($conn, $sql);
                $showAlert=true;

            }
            else{
                $showError="Passwords do not match !";
            }
        }

    }

?>
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Signup for cForum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Username</label>
                        <input type="text" class="form-control" id="uname" name="signupUname" aria-describedby="emailHelp">
                        
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                        <div id="emailHelp" class="form-text">Passwords must be same</div>
                    </div>
                    <center><button type="submit" class="btn btn-primary">Submit</button></center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
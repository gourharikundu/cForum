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
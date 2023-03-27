<?php include "partials/_dbconnect.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cForum-Threalist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php include "partials/_header.php"; 
            if(isset($_GET["catid"])){
                $id=$_GET["catid"];
            }
            if(isset($_POST["threadtitle"])){
                $thread_title= $_POST["threadtitle"];
                $thread_desc=$_POST["threaddesc"];
                $thread_postedby_user_id=$_SESSION["loggedin_user_id"];
                
                $sql="INSERT INTO `thread` (`thread_title`, `thread_description`, `cat_id`, `user_id`, `date`) VALUES ('$thread_title', '$thread_desc', '$id', '$thread_postedby_user_id', current_timestamp());";
                $result=mysqli_query($conn, $sql);
                if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success !</strong> Your Question has been Posted.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error !</strong> There was some error while posting your Question.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        ?>
    <div class="container my-4">
        <?php
            if(isset($_GET["catid"])){
                $id=$_GET["catid"];
                $sql="SELECT * FROM `category` WHERE `cat_id`=$id;";
                $result=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);
                echo '
                    <div class="alert alert-info" role="alert">
                        <h2 class="alert-heading">'.$row['cat_title'].'</h2>
                        <p>'.$row["cat_description"].'</p>
                        <hr>
                        <p class="mb-0">Some ruels to be followed strictly: Be courteous and respectful,
                            Appreciate that others may have an opinion different from yours,
                            Stay on  the topic,
                            Share your knowledge,
                            Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
                            
                        <div class="mt-3">Categories can be posted by <b>Admin Only</b></div>
                    </div>
                ';
            }   
        ?>
    </div>
    <div class="container my-4">
        <h1>Ask a Question</h1>
        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
                echo '<div class="container my-4">
                        <form method="post">
                            <div class="mb-3">
                                <label for="question" class="form-label">What is your Quesion? </label>
                                <input type="text" class="form-control" id="threadtitle" name="threadtitle" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="threaddesc" class="form-label">Ellaborate your Question</label>
                                <textarea class="form-control" id="threaddesc" name="threaddesc" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>';
            }
            else{
                echo '<p>You have to Login to ask a question</p>';
            }
        ?>
        
    </div>
    <div class="container">
        <h1>Browse Questions</h1>
        <?php
            $notFound=true;
            $sql="SELECT * FROM `thread` where `cat_id`='$id'";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
                $thread_id=$row["thread_id"];
                $thread_time=$row["date"];

                $thread_user_id=$row['user_id'];
                $sql2="SELECT * FROM `users` where `user_id`='$thread_user_id'";
                $result2=mysqli_query($conn, $sql2);
                $row2=mysqli_fetch_assoc($result2);
                $thread_user_name=$row2["username"];

                $notFound=false;
                echo '
                <div class="d-flex my-3">
                    <div class="flex-shrink-0">
                        <img src="/forum/images/userImage.png" width="50px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="my-0"><a class="text-dark" href="/forum/threads.php?threadid='.$thread_id.'">'.$row["thread_title"].'</a></h5>
                        '.$row["thread_description"].'
                    </div>
                    <p>Asked by '.$thread_user_name.' at '.$thread_time.'</p>
                </div>
                ';
            }
            if($notFound){
                echo '<div class="alert alert-warning my-4" role="alert">
                        <h4 class="alert-heading">No result Found</h4>
                        <hr>
                        <p class="mb-0">Be the first one to Ask something</p>
                    </div>';
            }
        ?>
    </div>
    <?php include "partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>
</html>
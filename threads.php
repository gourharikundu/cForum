<?php include "partials/_dbconnect.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cForum-Thread</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <div class="container my-4">
        <?php
            $id=$_GET["threadid"];
            //session_start();
            if(isset($_POST["comment"])){
                $comment=$_POST["comment"];
                //echo $_SESSION['username'];
                $commentby_user_id=$_SESSION['loggedin_user_id'];

                $sql="INSERT INTO `comment` (`comment`, `thread_id`, `user_id`, `date`) VALUES ('$comment', '$id', '$commentby_user_id', current_timestamp());";
                $result=mysqli_query($conn, $sql);
                if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success !</strong> Your Reply has been Posted.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error !</strong> There was some error while posting your reply.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }

            $sql="SELECT * FROM `thread` WHERE `thread_id`='$id';";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);

            $thread_user_id=$row["user_id"];
            $sql2="SELECT * FROM `users` where `user_id`='$thread_user_id'";
            $result2=mysqli_query($conn, $sql2);
            $row2=mysqli_fetch_assoc($result2);
            $thread_user_name=$row2["username"];


            echo '
                <div class="alert alert-secondary" role="alert">
                    <h2 class="alert-heading">'.$row['thread_title'].'</h2>
                    <p>'.$row["thread_description"].'</p>
                    <hr>
                    <p class="mb-0">Some ruels to be followed strictly: Be courteous and respectful,
                            Appreciate that others may have an opinion different from yours,
                            Stay on  the topic,
                            Share your knowledge,
                            Refrain from demeaning, discriminatory, or harassing behaviour and speech.
                    </p>                            
                     <div class="mt-3">Question Asked by <b>'.$thread_user_name.'</b></div>
                </div>

            ';

            

        ?>
    </div>
    <div class="container mt-4">
        <h2>Answer this Question</h2>
        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
                echo '<form method="post">
                        <div class="mb-3 mt-3">
                            <label for="threaddesc" class="form-label">Add your Reply</label>
                            <textarea class="form-control" id="threaddesc" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>';
            }else{
                echo '<p>You have to Login to answer question</p>';
            }
        ?>
        

    </div>
    <div class="container my-4">
        <h2>Explore the comments !</h2>
        <?php
            $notFound=true;
            $sql="SELECT * FROM `comment` where `thread_id`='$id'";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)){
                $thread_id=$row["thread_id"];

                $comment_user_id=$row["user_id"];    
                $sql2="SELECT * FROM `users` where `user_id`='$comment_user_id'";
                $result2=mysqli_query($conn, $sql2);
                $row2=mysqli_fetch_assoc($result2);
                $comment_user_name=$row2["username"];

                $notFound=false;
                echo '
                <div class="d-flex my-3">
                    <div class="flex-shrink-0">
                        <img src="/forum/images/userImage.png" width="50px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="my-0">Question answered by '.$comment_user_name.'</h6>
                        '.$row["comment"].'
                    </div>
                </div>
                ';
            }
            if($notFound){
                echo '<div class="alert alert-warning my-4" role="alert">
                        <h4 class="alert-heading">No Reply Found !</h4>
                        <p class="mb-0">Be the first one to answer this question.</p>
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

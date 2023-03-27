<?php include "partials/_dbconnect.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cForum-Coding Discussion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        #mainContainer{
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <?php
        include "partials/_header.php";
        $query=$_GET["searchQuery"];
    ?>
    <div class="container my-5" id="mainContainer">
        <h1>Serach results for <?php echo $query?></h1>
        <div class="container mt-4">      
            <?php
                $notFound=true;
                $sql="SELECT * FROM `thread` WHERE match (thread_title, thread_description) against ('$query')";
                $result=mysqli_query($conn, $sql);
                while($row=mysqli_fetch_assoc($result)){
                    $notFound=false;
                    $thread_title=$row["thread_title"];
                    $thread_desc=$row["thread_description"];
                    $thread_id=$row["thread_id"];
                    echo '<div class="container">
                            <h3><a href="/forum/threads.php?threadid='.$thread_id.'" class="text-dark">'.$thread_title.'</a></h3> 
                            <p>'.$thread_desc.'</p>   
                        </div>
                        ';
                }
                if($notFound){
                    echo '<div class="container my-4">
                            <div class="alert alert-warning my-4" role="alert">
                                <h4 class="alert-heading">No Reply Found !</h4>
                                <p class="mb-0">Be the first one to answer this question.</p>
                            </div>    
                        </div>';
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
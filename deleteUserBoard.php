<?php
    session_start();
    require_once("dbManager.php");

    if(isset($_POST["delete_id"]))
    {
        $boardId = $_POST["delete_id"];

        $img = getImgBoard($boardId);
        if($img != null)
        {
            for($i=0; $i < count($img); $i++)
            {
                $file_path = "uploads/".$img[$i];
                unlink($file_path);
            }
        }

        deleteBoardData($boardId);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie Reviewer</title>

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200&family=Roboto:wght@100;300&display=swap" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">


    <!-- icon from font font-awesome -->
    <script src="https://kit.fontawesome.com/e2552fe58e.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>

    <!-- navbar -->
    <nav class="navbar fixed-top navbar-expand-md mx-auto navbar-light bg-light" aria-label="Fourth navbar example">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-utensils fa-xl" style="color: #fa8500;"></i></a>
            <a class="navbar-brand" id="company_logo" href="#">Foodie Reviewer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav  mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?return=1" id="home">หน้าหลัก</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="addTopic.php">สร้างกระทู้</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="deleteUserBoard.php">แก้ไข/ลบ กระทู้</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav mb-2 mb-md-0 ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link active text-right" aria-current="page" href="login.php?return=3" >Log out</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <?php

        $userId = $_SESSION["user_id"];
        $topics = getTopicUser($userId);

        if($topics != null)
        {
            echo "<div class='album py-5 my-5'><div class='container'><div class='row row-cols-1 g-3'>";

            for($i = 0; $i < count($topics); $i++)
            {
                $boardId = $topics[$i]["boardId"];
                $header = $topics[$i]["topic"];
                echo "<div class='col'><div class='card shadow-sm'><div class='card-body'>";

                echo "<h4 class='card-text'>".$header."</h4>";

                echo    '<form action="deleteUserBoard.php" method="post">
                        <input type="hidden" name="delete_id" value="'.$boardId.'">
                        <div class="d-flex justify-content-end align-items-center py-2">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </div>
                        </form> ';

                echo "</div></div></div>";
            }

            echo "</div></div></div>";
        }
        else
        {
            echo "<h1>Not Found Topics</h1>";
        }

    ?>

    <!-- <div class="album py-5 my-5">
        <div class="container">

            <div class="row row-cols-1 g-3">

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                        <h4 class="card-text">This is a wiional content. This content is a little bit longer.</h4>
                        
                        <form action="deleteUserBoard.php" method="post">
                            <input type="hidden" name="delete_id" value="">
                            <div class="d-flex justify-content-end align-items-center py-2">
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </form>
                        

                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                        <h4 class="card-text">This is a wiional content. This content is a little bit longer.</h4>
                        
                        <div class="d-flex justify-content-end align-items-center py-2">
                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                        </div>

                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                        <h4 class="card-text">This is a wiional content. This content is a little bit longer.</h4>
                        
                        <div class="d-flex justify-content-end align-items-center py-2">
                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                        </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div> -->


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
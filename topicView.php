<?php
    require_once("dbManager.php");
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
   
    <main>
            <section class="jumbotron text-left" style="width:75%; margin-left:auto; margin-right:auto;">
                <div class="container">

                    <?php
                        

                        session_start();

                        if(isset($_GET["return"]) || isset($_POST["boardId"]))
                        {

                            if(isset($_GET["return"])){
                                $boardId = $_GET["return"];
                            }
                            
                            if(isset($_POST["boardId"])){
                                $boardId = $_POST["boardId"];
                            }

                            $topicData = getTopicById($boardId);
                            $header = $topicData["header"];
                            $content = $topicData["content"];
                            $ownerName = $topicData["ownerName"];

                            echo "<h1 class='jumbotron-heading'>".$header."</h1>";
                            echo "<p class='lead py-3'>".$content."</p>";
                            echo "<p class='mb-0 opacity-75' >เจ้าของกระทู้:".$ownerName."</p>";
                        }

                    ?>
                </div>

                <div class="album   mt-5">
                    <div class="container">
                        <div class="row" id="imgContainer">
                            <?php
                                $img = getImgBoard($boardId);

                                if($img != null)
                                {
                                    for($i=0; $i < count($img); $i++)
                                    {
                                        $file_path = "uploads/".$img[$i];
                                        echo "<div class='col-md-4'>";
                                        echo "<div class='card mb-4 box-shadow'>";
                                        echo "<img class='card-img-top' style='height: 300px; width: 100%; display: block;' src='".$file_path."' data-holder-rendered='true'>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                
                <form <?php echo "action= 'topicView.php?return".$boardId."'" ?> method="post">
                        <div class="input-group py-3">
                            <span class="input-group-text">comment</span>
                            <textarea rows="4" name="comment"  class="form-control" aria-label="With textarea"></textarea>
                        </div>
                        
                        <input type="hidden" id="custId" name="boardId" value= <?php echo "'".$boardId."'" ?>>

                        <div>
                            <button type="submit" name="submitComment" class="btn btn-primary my-2 mx-auto">ตอบกระทู้</button>
                        </div>
                </form>

                <?php

                    if(isset($_POST["submitComment"]) && (strlen($_POST["comment"]>0)))
                    {
                        $comment = $_POST["comment"];
                        $userId = $_SESSION["user_id"];       

                        insertNewComment($boardId, $userId, $comment);
                    }

                    $comments = getAllCommentBoard($boardId);

                    if($comments != null)
                    {
                        echo "<div class='album py-5 '>";
                        echo "<div class='container'>";
                        echo "<div class='row row-cols-1'>";

                        for($i=0; $i<count($comments); $i++)
                        {
                            $userNameComment = $comments[$i]["userNameComment"];
                            $comment_txt = $comments[$i]["comment"];

                            echo "<div class='col mb-4'><div class='card shadow-sm'><div class='card-body'>";
                            echo "<p class='card-text'>".$comment_txt."</p>";
                            echo "<div class='d-flex justify-content-end align-items-center'><small class='text-body-secondary'>ผู้ตอบ:".$userNameComment."</small></div>";
                            echo "</div></div></div>";
                        }

                        echo "</div></div></div>";
                    }

                ?>
 
               
            </section>
        </main>


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
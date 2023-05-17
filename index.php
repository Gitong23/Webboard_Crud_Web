<?php
    session_start();
    require_once("dbManager.php");

    if(!isset($_POST["submit"]) && !isset($_GET["return"]) )
    {
        //redirection to exiting page
        header("location: login.php");
    }

    if(isset($_GET["return"])){
        if(strlen($_SESSION["user_email"])==0)
        {
            header("location: login.php");
        }
    }

    if(isset($_POST["email"]) && isset($_POST["password"]))
    {
        $email      = trim($_POST["email"]);
        $password   = trim($_POST["password"]);

        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;

        if($email=="" || $password == "")
        {
            header("location: login.php?return=1");
            exit;
        }

        $user = getLoginUser($email, $password);
        if($user == null){
            header("location: login.php?return=2");
            exit;
        }
        else
        {
            $_SESSION["user_id"]    = $user["user_id"];
            $_SESSION["user_name"]  = $user["user_name"];
            $_SESSION["user_email"] = $user["user_email"];
        }
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

    
    <script>
        $( document ).ready(function() {

            $("#topic_container").load("showAllTopic.php", function(responseTxt, statusTxt, xhr)
                {
                    if(statusTxt =="error")alert("Error: "+xhr.status+":"+xhr.statusText);
                }
            );


            

        });
    </script>

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
                        <a class="nav-link active" aria-current="page" href="addTopic.php" >สร้างกระทู้</a>
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
        <section>
            <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">

                <div class="list-group" id="topic_container" style= "width : 75%">
                </div>
            </div>   
        </section>
    </main>



    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
<?php

    require_once("dbManager.php");

    session_start();

    if(isset($_POST["submit"]) && isset($_POST["topic"]))
    {
        if($_POST["topic"]=="")
        {
            header("location: addTopic.php?return1");
            exit;
        }
        else
        {
            //should return board id
            insertBoard($_SESSION["user_id"], $_POST["topic"], $_POST["content"]);
            $_SESSION["topic"] = $_POST["topic"];
            $_SESSION["boardId"] = getLastestBoardId();
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

    <style>
        .warning{
            color: red;
        }

        .success{
            color: green;
        }

    </style>

    <!-- icon from font font-awesome -->
    <script src="https://kit.fontawesome.com/e2552fe58e.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <script>
        $( document ).ready(function() {
            
            let boardId =  $("#boardId").val();

            $("#imgContainer").load("showImgCard.php?board_id="+boardId, function(responseTxt, statusTxt, xhr)
                {
                    if(statusTxt =="error")alert("Error: "+xhr.status+":"+xhr.statusText);
                }
            )

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
            <section class="jumbotron text-center">
                <div class="container">
                    <?php echo "<h1 class='jumbotron-heading'>".$_SESSION["topic"]."</h1>" ?>
                    <p class="lead text-muted">โปรดใช้คำสุภาพ หลีกเลี่ยงหัวข้อที่นำมาสู่ความขัดแย้ง หรือทำให้ผู้อื่นได้รับความเสื่อมเสีย</p>
                
                    <form action="index.php" method="post">
                        <p>
                            <!-- <a href="index.php" class="btn btn-primary my-2 my-3">สร้างกระทู้</a> -->
                            <button type="submit" name="submit" class="btn btn-primary my-2 my-3">สร้างกระทู้</button>
                        </p>
                    </form>

                    <?php

                        if(isset($_POST["submitImg"])  && strlen(basename($_FILES["fileToUpload"]["name"])) > 0  )
                        {
                            $target_dir = "uploads/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                            // Check if image file is a actual image or fake image
                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                            if($check !== false) {
                                echo "<p class='warning'>File is an image - " . $check["mime"] . ".</p>";
                                $uploadOk = 1;
                            } 
                            else 
                            {
                                echo "<p class='warning'>File is not an image.</p>";
                                $uploadOk = 0;
                            }

                            // Check if file already exists
                            if (file_exists($target_file)) {
                                echo "<p class='warning'>Sorry, file already exists.</p>";
                                $uploadOk = 0;
                            }

                            // Allow certain file formats
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                echo "<p class='warning'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
                                $uploadOk = 0;
                            }

                            // Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {
                                echo "<p class='warning'>Sorry, your file was not uploaded.</p>";
                            // if everything is ok, try to upload file
                            } else {

                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                                    insertImg($_SESSION["boardId"], basename($_FILES["fileToUpload"]["name"]) );
                                    echo "<p class='success'>Upload Success</p>";

                                } else {
                                    echo "<p class='warning'>Sorry, there was an error uploading your file.</p>";
                                }
                            }
                        }
                        else
                        {
                            echo "<p class='warning'>โปรดเลือกไฟล์</p>";
                        }

                    
                    ?>
                    
                    <input type="hidden" id="boardId" value='<?php echo $_SESSION["boardId"]; ?>'>

                    <form action="addImg.php" method="post" enctype="multipart/form-data">
                        <label for="formFileSm" class="form-label">เพิ่มรูปภาพ</label>
                        <input class="form-control form-control-sm" type="file" name="fileToUpload" id="fileToUpload"/>
                        <button class="btn btn-secondary my-3" type="submit" name="submitImg">+ Add Photo</button>
                    </form>
                </div>

                <div class="album  bg-light">
                    <div class="container">

                    <div class="row" id="imgContainer">

                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 300px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22288%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20288%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1881445673a%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1881445673a%22%3E%3Crect%20width%3D%22288%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2296.82500076293945%22%20y%3D%22118.74000034332275%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 300px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22288%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20288%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1881445673a%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1881445673a%22%3E%3Crect%20width%3D%22288%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2296.82500076293945%22%20y%3D%22118.74000034332275%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 300px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22288%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20288%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1881445673a%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1881445673a%22%3E%3Crect%20width%3D%22288%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2296.82500076293945%22%20y%3D%22118.74000034332275%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 300px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22288%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20288%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1881445673a%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1881445673a%22%3E%3Crect%20width%3D%22288%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2296.82500076293945%22%20y%3D%22118.74000034332275%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            </div>
                        </div>

                    </div>
                </div>

               
            </section>
        </main>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
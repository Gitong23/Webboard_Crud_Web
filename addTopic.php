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
            <section class="jumbotron text-left">
                <div class="container">
                    <h1 class="jumbotron-heading">สร้างกระทู้</h1>
                    <p class="lead text-muted">โปรดใช้คำสุภาพ หลีกเลี่ยงหัวข้อที่นำมาสู่ความขัดแย้ง หรือทำให้ผู้อื่นได้รับความเสื่อมเสีย</p>
                
                    <form action="addImg.php" method="post">
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">หัวข้อกระทู้</span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Username"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                                name="topic"
                            />
                        </div>

                        <div class="input-group py-3">
                            <span class="input-group-text">เนื้อหา</span>
                            <textarea rows="6" name="content"  class="form-control" aria-label="With textarea"></textarea>
                        </div>

                        <p>
                            <!-- <a href="#" class="btn btn-primary my-2">สร้างกระทู้</a> -->
                            <button type="submit" name="submit" class="btn btn-primary my-2">สร้างกระทู้</button>
                        </p>

                    </form>

                </div>


               
            </section>
        </main>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>

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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

    <style>
        .warning{
            color : red;
        }
    </style>

    <!-- icon from font font-awesome -->
    <script src="https://kit.fontawesome.com/e2552fe58e.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body class="text-center">

    <main class="form-signin w-50 mx-auto mt-5">
        <form action="index.php" method="POST">
            <img class="mb-4" src="asset/login_logo.jpg" alt="" width="150" height="150">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <?php
                error_reporting(E_ERROR | E_PARSE);
                session_start();

                if(isset($_GET["return"]) && $_GET["return"]==1)
                {
                    echo "<h5 class='warning'>* Plase fill email or password!! *</h5>";
                }
                if(isset($_GET["return"]) && $_GET["return"]==2)
                {
                    echo "<h5 class='warning'>* Wrong email or password!! *</h5>";
                }
                
                if(isset($_GET["return"]) && $_GET["return"]==3)
                {
                    session_unset();
                    session_destroy();
                }
            ?>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $_SESSION["email"]; ?>">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div>
                <a href="register.php" style="font-size: 18px">Register</a>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="submit">Sign in</button>


            <p class="mt-5 mb-3 text-body-secondary">© Foodie Reviewer 2023</p>
        </form>
    </main>


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
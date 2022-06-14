<?php 
require("library.php");

$login = new Login();

$error = "";

if( isset($_POST["login"]) ){
    $info = $login->readData($_POST["username"], $_POST["password"]);

    if($info){ 
        session_start();
        $_SESSION['username'] = $_POST['username'];
        header("refresh:0;url=halaman_home.php");
    }else{
        $error = "Username dan Password salah";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create/Edit Periode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>.dropdown-hover-all .dropdown-menu, .dropdown-hover > .dropdown-menu.dropend { margin-left:-1px !important }</style>
</head>
<body style="background-color:#D9E4DD;">
    <div class="container" style="max-width:1000px;">

        <!-- HEADER -->

        <header style="padding:30px; text-align:center;">
            <h1>PERSATUAN SABONA BATAK MARTUBUNG</h1>
            <p>By: Miftahul Ulyana Hutabarat - 0702192031</p>
        </header>

        <!-- NAVBAR  -->

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#BAC7A7;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Login</a>
            </div>
        </nav>

        <!-- MAIN  -->

        <main style="max-width:600px; margin:10px auto;">
            
            <!-- INFO -->

            <?php if($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
            <?php header("refresh:2;url=halaman_login.php"); endif; ?>

            <!-- CARD TABLE  -->

            <div class="card" style="background-color:#E5E4CC; margin:10px auto;">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">

                    <!-- FORM LOGIN  -->

                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="staticEmail" class="form-label">Username</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="username">	
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="staticEmail" class="form-label">Password</label>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                            <button type="submit" name ="login" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- FOOTER  -->

        <footer style="text-align:center; padding:8px; background-color:#BAC7A7;">
            <p>© 2021 Miftahul Ulyana Hutabarat</p>
        </footer>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>
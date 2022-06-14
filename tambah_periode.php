<?php 
require("library.php");

$periode = new Periode();

$error          = "";
$sukses         = "";
$id_prd         = "";
$nama_prd       = "";
$mulaitgl_prd   = "";

if(isset($_POST["submit"])){
    $nama_prd       = $_POST["nama_prd"];
    $mulaitgl_prd   = $_POST["mulaitgl_prd"];

    if(isset($_GET["btnEdit_periode"])){// update
        $id_prd = $_GET["id_prd"];
        
        $info = $periode->updateData($id_prd, $nama_prd, $mulaitgl_prd);

        if($info){
            $sukses = "Berhasil mengupdate data";
        }else if($info == 0){
            $sukses = "Batal mengupdate data";
        }else{
            $error = "Gagal mengupdate data";
        }
    }else{// create
        $info = $periode->createData($nama_prd, $mulaitgl_prd);
        
        $row_periode = $periode->readData("SELECT * FROM tb_periode ORDER BY id_prd DESC")[0];
        $id_prd = $row_periode["id_prd"];

        if($info){
            $sukses = "Berhasil memasukkan data";
        }else{
            $error = "Gagal memasukkan data";
        }
    }
}

if(isset($_GET["btnEdit_periode"])){
    $id_prd = $_GET["id_prd"];
    $get_byId_periode = $periode->readData("SELECT * FROM tb_periode WHERE id_prd = $id_prd")[0];

    $id_prd         = $get_byId_periode["id_prd"];
    $nama_prd       = $get_byId_periode["nama_prd"];
    $mulaitgl_prd   = $get_byId_periode["mulaitgl_prd"];

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
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="background-color:#E5E4CC;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="halaman_home.php">Home</a>
                        <a class="nav-link" href="halaman_anggota.php">Anggota</a>
                        <a class="nav-link" href="halaman_logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- MAIN  -->

        <main style="max-width:600px; margin:10px auto;">
            
            <!-- INFO -->

            <?php if($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php header("refresh:2;url=halaman_home.php?id_prd=$id_prd"); endif; ?>
            <?php if($sukses): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses; ?>
                </div>
            <?php header("refresh:2;url=halaman_home.php?id_prd=$id_prd"); endif; ?>

            <!-- CARD TABLE  -->

            <div class="card" style="background-color:#E5E4CC; margin:10px auto;">
                <div class="card-header">
                    Create/Edit Periode
                </div>
                <div class="card-body">

                    <!-- CREATE/EDIT DATA PERIODE  -->

                    <form action="" method="POST">
                        <input type="hidden" class="form-control" name="id_prd" value="<?php echo $id_prd; ?>">	
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="staticEmail" class="form-label">Nama Periode</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_prd" value="<?php echo $nama_prd; ?>">	
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="staticEmail" class="form-label">Tanggal Mulai</label>
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" name="mulaitgl_prd" value="<?php echo $mulaitgl_prd; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                            <button type="submit" name ="submit" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
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
<?php 
ob_start();//untuk perbaiki bug di INFO
require("library.php");
require("session.php");

$biayalainnya   = new Biayalainnya();

//read
$rows_biayalainnya = $biayalainnya->readData("SELECT * FROM tb_biayalainnya ORDER BY id_bl");

$error      = "";
$sukses     = "";
$id_bl     = "";
$idars_bl  = "";
$nama_bl  = "";
$tgl_bl    = "";
$bl        = "";

if(isset($_POST['btnTambah_biayalainnya'])){
    if(isset($_COOKIE["id_ars"])){
        $idars_bl  = $_COOKIE["id_ars"];
    }
    
	$nama_bl  = htmlspecialchars($_POST['nama_bl']);
    $tgl_bl    = htmlspecialchars($_POST['tgl_bl']);
	$bl        = htmlspecialchars($_POST['bl']);
	
    if($nama_bl){
        $info = $biayalainnya->createData(/*$idars_bl,*/ $nama_bl, $tgl_bl, $bl);

        if($info > 0){
            $sukses = "Sukses memasukkan data";
        }else{
            $error = "Gagal memasukkan data";
        }
    }else{
        $error = "Pastikan nama terisi";
    }
}

if(isset($_POST['btnEdit_biayalainnya'])){
    if(isset($_COOKIE["id_ars"])){
        $idars_bl  = $_COOKIE["id_ars"];
    }

	$id_bl     = htmlspecialchars($_POST['id_bl']);
	$nama_bl  = htmlspecialchars($_POST['nama_bl']);
    $tgl_bl    = htmlspecialchars($_POST['tgl_bl']);
	$bl        = htmlspecialchars($_POST['bl']);
	
    if($nama_bl){
        $info = $biayalainnya->updateData($id_bl, /*$idars_bl,*/ $nama_bl, $tgl_bl, $bl);

        if($info > 0){
            $sukses = "Sukses mengubah data";
        }else if($info == 0){
            $sukses = "Batal mengubah data";
        }else{
            $error = "Gagal mengubah data";
        }
    }else{
        $error = "Pastikan nama terisi";
    }
}

if(isset($_GET['btnHapus_biayalainnya'])){
	$id_bl = $_GET['id'];

	$info = $biayalainnya->deleteData($id_bl);

	if($info > 0){
        $sukses = "Sukses menghapus data";
    }else{
        $error = "Gagal menghapus data";
    }
}

if(isset($_POST["btnCari_biayalainnya"])){
    $keyword = $_POST['keyword'];
    $rows_biayalainnya = $biayalainnya->readData("SELECT * FROM tb_biayalainnya WHERE nama_bl LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biaya Lainnya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                        <a class="nav-link" href="halaman_home.php">Home</a>
                        <a class="nav-link" href="halaman_anggota.php">Anggota</a>
                        <a class="nav-link" href="halaman_logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- MAIN  -->

        <main style="max-width:800px; margin:10px auto;">

            <!-- INFO -->

            <?php if($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php header("refresh:1;url=halaman_biayalainnya.php"); endif; ?>
            <?php if($sukses): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses; ?>
                </div>
            <?php header("refresh:1;url=halaman_biayalainnya.php"); endif; ?>

            <!-- CARD TABLE  -->

            <div class="card" style="background-color:#E5E4CC; margin:10px auto;">
                <div class="card-header">
                    Daftar Biaya Lainnya
                </div>
                <div class="card-body">

                    <!-- BUTTON TAMBAH DATA  -->

                    <div class="mb-3 row" >
                        <button type="button" class="btn btn-primary col-sm-2" style="background-color: #87A8D0; border: 1px solid #87A8D0; margin-left:12px;" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            Tambah
                        </button>
                    </div>

                    <!-- POPUP MODAL CREATE DATA -->

                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color:#BAC7A7;">
                                <form action="" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="background-color:#E5E4CC;">
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Nama</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="nama_bl">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Tanggal</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" name="tgl_bl">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Biaya</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="bl">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name ="btnTambah_biayalainnya" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- SEARCH  -->
                    
                    <form action="" method="POST" class="mb-3 row">
                        <div class="col">
                            <input name="keyword" class="form-control" type="search" placeholder="Cari Nama Biaya Lainnya" aria-label="Cari">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" name="btnCari_biayalainnya" style="background-color:#dcdbbc; border: 0.5px solid #97954e; color:#97954e;" type="submit">Cari</button>
                        </div>
                    </form>

                    <!-- TABLE  -->

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Biaya</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($rows_biayalainnya as $row_biayalainnya): ?>
                            <tr>
                                <td scope="col"><?php echo $i; ?></td>
                                <td scope="col"><?php echo $row_biayalainnya["nama_bl"];?></td>
                                <td scope="col"><?php echo $row_biayalainnya["tgl_bl"]; ?></td>
                                <td scope="col"><?php echo $row_biayalainnya["bl"]; ?></td>
                                <td scope="col">

                                    <!-- BUTTON EDIT DATA  -->

                                    <div class="mb-1 row">
                                        <button type="button" class="btn btn-warning" style="background-color: #F5B17B; border: 1px solid #F5B17B; width: 90%;" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row_biayalainnya["id_bl"]; ?>">Edit</button>
                                    </div>
                                    
                                    <!-- POPUP MODAL EDIT DATA  -->

                                    <div class="modal fade" id="modalEdit<?php echo $row_biayalainnya["id_bl"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color:#BAC7A7;">
                                                <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="background-color:#E5E4CC;">
                                                        <input type="hidden" class="form-control" name="id_bl" value="<?php echo $row_biayalainnya["id_bl"];?>">
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Nama Anggota</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="nama_bl" value="<?php echo $row_biayalainnya["nama_bl"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Tanggal</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="date" class="form-control" name="tgl_bl" value="<?php echo $row_biayalainnya["tgl_bl"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">biayalainnya</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="bl" value="<?php echo $row_biayalainnya["bl"];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name ="btnEdit_biayalainnya" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BUTTON HAPUS DATA  -->

                                    <div class="mb-1 row">
                                        <a 	href="halaman_biayalainnya.php?btnHapus_biayalainnya&id=<?php echo $row_biayalainnya["id_bl"];?>" 
                                        onclick="return confirm('yakin ingin menghapus data?')"
                                        class="btn btn-danger" style="background-color: #EF7B7B; border: 1px solid #EF7B7B; width: 90%;">
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- FOOTER  -->

        <footer style="text-align:center; padding:8px; background-color:#BAC7A7;">
            <p>© 2021 Miftahul Ulyana Hutabarat</p>
        </footer>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
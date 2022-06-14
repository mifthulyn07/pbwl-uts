<?php 
ob_start();//untuk perbaiki bug di INFO
require("library.php");
require("session.php");

$bayar      = new Bayar();
$arisan     = new Arisan();
$anggota    = new Anggota();

$error      = "";
$sukses     = "";

$id_byr     = "";
$idars_byr  = "";
$idagt_byr  = "";
$tgl_byr    = "";
$byr        = "";

$id_ars             = "";
$idprd_ars          = "";
$jns_ars            = "";
$nama_ars           = "";
$tgl_ars            = "";
$masuk_ars          = "";
$keluar_ars         = "";
$ket_ars            = "";

$rows_bayar = [];

// READ ANGGOTA 
$rows_anggota   = $anggota->readData("SELECT * FROM tb_anggota ORDER BY id_agt");

// UBAH SEMUA MENURUT ARISAN
if(isset($_GET["id_ars"])){
    $id_ars         = $_GET["id_ars"];

    $rows_bayar     = $bayar->readData("SELECT * FROM tb_bayar WHERE idars_byr = $id_ars");
    $getby_id_ars   = $arisan->readData("SELECT * FROM tb_arisan WHERE id_ars = $id_ars")[0];

    $id_ars         = $getby_id_ars["id_ars"];
    $idprd_ars      = $getby_id_ars["idprd_ars"];
    $jns_ars        = $getby_id_ars["jns_ars"];
    $nama_ars       = $getby_id_ars["nama_ars"];
    $tgl_ars        = $getby_id_ars["tgl_ars"];
    $keluar_ars     = $getby_id_ars["keluar_ars"];
    $ket_ars        = $getby_id_ars["ket_ars"];
}

// TAMBAH BAYAR 
if(isset($_POST['btnTambah_bayar'])){
    $idars_byr  = htmlspecialchars($_POST['idars_byr']);
	$idagt_byr  = htmlspecialchars($_POST['idagt_byr']);
    $tgl_byr    = htmlspecialchars($_POST['tgl_byr']);
	$byr        = htmlspecialchars($_POST['byr']);
	
    if($idagt_byr){
        $info = $bayar->createData($idars_byr, $idagt_byr, $tgl_byr, $byr);

        if($info > 0){
            $sukses = "Sukses memasukkan data";
        }else{
            $error = "Gagal memasukkan data";
        }
    }else{
        $error = "Pastikan nama terisi";
    }
}

// EDIT BAYAR 
if(isset($_POST['btnEdit_bayar'])){
	$id_byr     = htmlspecialchars($_POST['id_byr']);
    $idars_byr  = htmlspecialchars($_POST['idars_byr']);
	$idagt_byr  = htmlspecialchars($_POST['idagt_byr']);
    $tgl_byr    = htmlspecialchars($_POST['tgl_byr']);
	$byr        = htmlspecialchars($_POST['byr']);
	
    if($idagt_byr){
        $info = $bayar->updateData($id_byr, $idars_byr, $idagt_byr, $tgl_byr, $byr);

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

// HAPUS BAYAR 
if(isset($_GET['btnHapus_bayar'])){
	$id_byr = $_GET['id_byr'];

	$info = $bayar->deleteData($id_byr);

	if($info > 0){
        $sukses = "Sukses menghapus data";
    }else{
        $error = "Gagal menghapus data";
    }
}

// CARI ARISAN 
if(isset($_POST["btnCari_bayar"])){
    $keyword = $_POST['keyword'];
    $rows_anggota = $anggota->readData("SELECT * FROM tb_anggota WHERE nama_agt LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Arisan</title>
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
            <?php header("refresh:1;url=halaman_bayar.php?id_ars=$id_ars"); endif; ?>
            <?php if($sukses): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses; ?>
                </div>
            <?php header("refresh:1;url=halaman_bayar.php?id_ars=$id_ars"); endif; ?>

            <!-- CARD TABLE  -->
            
            <?php if($id_ars){ ?>
            <div class="card" style="background-color:#E5E4CC; margin:10px auto;">
            <?php }else{ ?>
            <div class="card" style="display:none; background-color:#E5E4CC; margin:10px auto;">
            <?php } ?>
                <div class="card-header">
                    Daftar Pembayaran Arisan <?php echo $nama_ars;?>
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
                                        <input type="text" class="form-control" name="idars_byr" value="<?php echo $id_ars;?>">
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Nama Anggota</label>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" aria-label="Default select example" name="idagt_byr">
                                                    <option selected>-Pilih-</option>
                                                    <?php foreach($rows_anggota as $row_anggota): ?>
                                                    <option value="<?php echo $row_anggota["id_agt"];?>">
                                                        <?php echo $row_anggota["nama_agt"];?>
                                                    </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Tanggal</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" name="tgl_byr">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Bayar</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="byr">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name ="btnTambah_bayar" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- SEARCH  -->
                    
                    <form action="" method="POST" class="mb-3 row">
                        <div class="col">
                            <input name="keyword" class="form-control" type="search" placeholder="Cari Anggota" aria-label="Cari">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" name="btnCari_bayar" style="background-color:#dcdbbc; border: 0.5px solid #97954e; color:#97954e;" type="submit">Cari</button>
                        </div>
                    </form>

                    <!-- TABLE  -->
                    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Bayar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $masuk_ars = 0; 
                            $i=1; 
                            foreach($rows_bayar as $row_bayar): 
                            $masuk_ars = $masuk_ars + $row_bayar["byr"];?>
                            <tr>
                                <?php foreach($rows_anggota as $row_anggota): 
                                if($row_bayar["idagt_byr"]===$row_anggota["id_agt"]):?>
                                <td scope="col"><?php echo $i; ?></td>
                                <td scope="col"><?php echo $row_bayar["idagt_byr"] = $row_anggota["nama_agt"];?></td>
                                <td scope="col"><?php echo $row_bayar["tgl_byr"]; ?></td>
                                <td scope="col"><?php echo $row_bayar["byr"]; ?></td>
                                <td scope="col">

                                    <!-- BUTTON EDIT DATA  -->

                                    <div class="mb-1 row">
                                        <button type="button" class="btn btn-warning" style="background-color: #F5B17B; border: 1px solid #F5B17B; width: 90%;" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row_bayar["id_byr"]; ?>">Edit</button>
                                    </div>
                                    
                                    <!-- POPUP MODAL EDIT DATA  -->

                                    <div class="modal fade" id="modalEdit<?php echo $row_bayar["id_byr"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color:#BAC7A7;">
                                                <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="background-color:#E5E4CC;">
                                                        <input type="text" class="form-control" name="id_byr" value="<?php echo $row_bayar["id_byr"];?>">
                                                        <input type="text" class="form-control" name="idars_byr" value="<?php echo $id_ars;?>">
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Nama Anggota</label>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-select" aria-label="Default select example" name="idagt_byr">
                                                                    <option value="">-Pilih-</option>
                                                                    <?php foreach($rows_anggota as $row_anggota): 
                                                                    if($row_bayar["idagt_byr"] == $row_anggota["nama_agt"]):?>
                                                                    <option selected value="<?php echo $row_anggota["id_agt"];?>">
                                                                        <?php echo $row_anggota["nama_agt"];?>
                                                                    </option>
                                                                    <?php continue; endif; ?>
                                                                    <option value="<?php echo $row_anggota["id_agt"];?>">
                                                                        <?php echo $row_anggota["nama_agt"];?>
                                                                    </option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Tanggal</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="date" class="form-control" name="tgl_byr" value="<?php echo $row_bayar["tgl_byr"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Bayar</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="byr" value="<?php echo $row_bayar["byr"];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name ="btnEdit_bayar" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BUTTON HAPUS DATA  -->

                                    <div class="mb-1 row">
                                        <a 	href="halaman_bayar.php?btnHapus_bayar&id_byr=<?php echo $row_bayar["id_byr"];?>&id_ars=<?php echo $id_ars;?>" 
                                        onclick="return confirm('yakin ingin menghapus data?')"
                                        class="btn btn-danger" style="background-color: #EF7B7B; border: 1px solid #EF7B7B; width: 90%;">
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; endforeach; $i++; endforeach; ?>
                            <tr>
                                <th colspan="2"><hr></th>
                                <th style="font-size: 110%;">Total</th>
                                <th style="font-size: 110%;">
                                    <?php echo $masuk_ars;
                                    // di update sesuai jumlah pemasukan bayar arisan 
                                    $arisan->updateData($id_ars, $idprd_ars, $jns_ars, $nama_ars, $tgl_ars, $masuk_ars, $keluar_ars, $ket_ars); ?>
                                </th>
                                <th><hr></th>
                            </tr>
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
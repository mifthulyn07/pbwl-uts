<?php 
require("library.php");
require("session.php");

$periode    = new Periode();
$arisan     = new Arisan();

$error_arisan       = "";
$sukses_arisan      = "";
$error_periode      = "";
$sukses_periode     = "";

$id_prd             = "";
$nama_prd           = "";
$mulaitgl_prd       = "";
$masuk_prd          = "";
$keluar_prd         = "";
$saldo_prd          = "";

$id_ars             = "";
$idprd_ars          = "";
$jns_ars            = "";
$nama_ars           = "";
$tgl_ars            = "";
$masuk_ars          = "";
$keluar_ars         = "";
$ket_ars            = "";

$rows_periode       = [];
$rows_arisan        = [];

// READ PERIODE 
$rows_periode   = $periode->readData("SELECT * FROM tb_periode ORDER BY id_prd");

// UBAH SEMUA MENURUT PERIODE 
if(isset($_GET["id_prd"])){
    $id_prd     = $_GET["id_prd"];

    $rows_arisan    = $arisan->readData("SELECT * FROM tb_arisan WHERE idprd_ars = $id_prd");
    $getby_id_prd   = $periode->readData("SELECT * FROM tb_periode WHERE id_prd = $id_prd")[0];

    $id_prd         = $getby_id_prd["id_prd"];
    $nama_prd       = $getby_id_prd["nama_prd"];
    $mulaitgl_prd   = $getby_id_prd["mulaitgl_prd"];
}

// HAPUS PERIODE 
if(isset($_GET['btnHapus_periode'])){
	$id_prd = $_GET['id_prd'];

	$info = $periode->deleteData($id_prd);    

    $getby_id_prd   = $periode->readData("SELECT * FROM tb_periode ORDER BY id_prd")[0];
    $id_prd         = $getby_id_prd["id_prd"];
	
    if($info > 0){
        $sukses_periode = "Sukses menghapus data";
    }else{
        $error_periode = "Gagal menghapus data";
    }
}

// TAMBAH ARISAN 
if(isset($_POST['btnTambah_arisan'])){
    $idprd_ars  = htmlspecialchars($_POST['idprd_ars']);
    $jns_ars    = htmlspecialchars($_POST['jns_ars']);
	$nama_ars   = htmlspecialchars($_POST['nama_ars']);
    $tgl_ars    = htmlspecialchars($_POST['tgl_ars']);
	$masuk_ars  = htmlspecialchars($_POST['masuk_ars']);
	$keluar_ars = htmlspecialchars($_POST['keluar_ars']);
	$ket_ars    = htmlspecialchars($_POST['ket_ars']);

    if($jns_ars){
        $info = $arisan->createData($idprd_ars, $jns_ars, $nama_ars, $tgl_ars, $masuk_ars, $keluar_ars, $ket_ars);

        if($info > 0){
            $sukses_arisan = "Sukses memasukkan data";
        }else{
            $error_arisan = "Gagal memasukkan data";
        }
    }else{
        $error_arisan = "Pastikan jenis terisi";
    }
}

// EDIT ARISAN 
if(isset($_POST['btnEdit_arisan'])){
    $id_ars     = htmlspecialchars($_POST['id_ars']);
    $idprd_ars  = htmlspecialchars($_POST['idprd_ars']);
    $jns_ars    = htmlspecialchars($_POST['jns_ars']);
	$nama_ars   = htmlspecialchars($_POST['nama_ars']);
    $tgl_ars    = htmlspecialchars($_POST['tgl_ars']);
	$masuk_ars  = htmlspecialchars($_POST['masuk_ars']);
	$keluar_ars = htmlspecialchars($_POST['keluar_ars']);
	$ket_ars    = htmlspecialchars($_POST['ket_ars']);
	
    if($jns_ars){
        $info = $arisan->updateData($id_ars, $idprd_ars, $jns_ars, $nama_ars, $tgl_ars, $masuk_ars, $keluar_ars, $ket_ars);

        if($info > 0){
            $sukses_arisan = "Sukses mengubah data";
        }else if($info == 0){
            $sukses_arisan = "Batal mengubah data";
        }else{
            $error_arisan = "Gagal mengubah data";
        }
    }else{
        $error = "Pastikan jenis terisi";
    }
}

// HAPUS ARISAN 
if(isset($_GET['btnHapus_arisan'])){
	$id_ars     = $_GET['id_ars'];
    $idprd_ars  = $_GET['idprd_ars'];

    $get_byId_arisan = $arisan->readData("SELECT * FROM tb_arisan WHERE id_ars = $id_ars AND idprd_ars = $idprd_ars")[0];
    
    $id_prd = $get_byId_arisan["idprd_ars"];

	$info = $arisan->deleteData($id_ars);

	if($info > 0){
        $sukses_arisan = "Sukses menghapus data";
    }else{
        $error_arisan = "Gagal menghapus data";
    }
}

// CARI ARISAN 
if(isset($_POST["btnCari_arisan"])){
    $keyword = $_POST['keyword'];
    $rows_arisan = $arisan->readData("SELECT * FROM tb_arisan WHERE idprd_ars LIKE '%$id_ars%' AND jns_ars LIKE '%$keyword%'");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        <main style="max-width:1000px; margin:10px auto;">

            <!-- INFO PERIODE-->

            <?php if($error_periode): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_periode; ?>
                </div>
            <?php header("refresh:1;url=halaman_home.php?id_prd=$id_prd"); endif; ?>
            <?php if($sukses_periode): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses_periode; ?>
                </div>
            <?php header("refresh:1;url=halaman_home.php?id_prd=$id_prd"); endif; ?>

            <!-- INFO ARISAN-->

            <?php if($error_arisan): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_arisan; ?>
                </div>
            <?php if($id_prd){header("refresh:2;url=halaman_home.php?id_prd=$id_prd");}
            else{header("refresh:2;url=halaman_home.php");} endif; ?>
            <?php if($sukses_arisan): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses_arisan; ?>
                </div>
            <?php if($id_prd){header("refresh:2;url=halaman_home.php?id_prd=$id_prd");}
            else{header("refresh:2;url=halaman_home.php");} endif; ?>

            <!-- PERIODE  -->
        
            <div class="dropdown mt-3"><?php  ?>
                <button class="btn dropdown-toggle" style="background-color: #E5E4CC; border: 1px solid #97954e; color: #97954e;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if($id_prd){
                    echo $nama_prd . " ( ". $mulaitgl_prd . " )";
                    }else{ ?>
                    >>> Pilih Periode <<<   
                    <?php } ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php foreach($rows_periode as $row_periode): ?>
                    <div class="dropdown dropend">
                        <div class="btn-group dropup">
                            <a class="dropdown-item" href="halaman_home.php?id_prd=<?php echo $row_periode["id_prd"];?>">
                                <?php echo $row_periode['nama_prd'] . " ( " . $row_periode['mulaitgl_prd'] . " )"; ?>
                            </a>
                            <a class="dropdown-item dropdown-toggle dropdown-toggle-split" href="#" id="dropdown-layouts" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-layouts">
                                <a class="dropdown-item" href="tambah_periode.php?btnEdit_periode&id_prd=<?php echo $row_periode["id_prd"];?>">Edit</a>
                                <a class="dropdown-item" href="halaman_home.php?btnHapus_periode&id_prd=<?php echo $row_periode["id_prd"];?>" onclick="return confirm('yakin ingin menghapus data?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="tambah_periode.php">Tambah Data</a>
                </div>
            </div>

            <!-- CARD TABLE  -->
            
            <?php if($id_prd){ ?>
            <div class="card" style="background-color:#E5E4CC; margin:10px auto;">
            <?php }else{ ?>
            <div class="card" style="display:none; background-color:#E5E4CC; margin:10px auto;">
            <?php } ?>
                <div class="card-header">
                    Table <?php echo $nama_prd; ?>
                </div>
                <div class="card-body">

                    <!-- BUTTON TAMBAH DAN CETAK DATA  -->

                    <div class="mb-3 row" >
                        <button type="button" class="btn btn-primary col-sm-2" style="background-color: #87A8D0; border: 1px solid #87A8D0; margin-left:12px;" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            Tambah
                        </button>
                        <a 	href="print_periode.php?id_prd=<?php echo $id_prd;?>" target="_blank" class="btn btn-success col-sm-2" style="background-color: #87A8A4; border: 1px solid #87A8A4; margin-left:10px;;">          
                            Cetak
                        </a>
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
                                        <input type="hidden" class="form-control" name="idprd_ars" value="<?php echo $id_prd;?>">
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Jenis</label>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" aria-label="Default select example" name="jns_ars">
                                                    <option value="" selected>-Pilih-</option>
                                                    <option value="Arisan">Arisan</option>
                                                    <option value="Donasi">Donasi</option>
                                                    <option value="Biaya Lainnya">Biaya Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Nama</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="nama_ars">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Tanggal</label>
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" name="tgl_ars">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Pemasukan</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="masuk_ars" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label for="staticEmail" class="form-label">Pengeluaran</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="keluar_ars" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                                            </div>
                                            <div class="col">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ket_ars"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name ="btnTambah_arisan" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- SEARCH  -->
                    
                    <form action="" method="POST" class="mb-3 row">
                        <div class="col">
                            <input name="keyword" class="form-control" type="search" placeholder="Cari" aria-label="Search">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" name="btnCari_arisan" style="background-color:#dcdbbc; border: 0.5px solid #97954e; color:#97954e;" type="submit">Cari</button>
                        </div>
                    </form>

                    <!-- TABLE  -->

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pemasukan</th>
                                <th scope="col">Pengeluaran</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($rows_arisan as $row_arisan): ?>
                            <tr>
                                <td scope="col"><?php echo $i; ?> </td>
                                <td scope="col"><?php echo $row_arisan["jns_ars"]; ?></td>
                                <td scope="col"><?php echo $row_arisan["nama_ars"]; ?></td>
                                <td scope="col"><?php echo $row_arisan["tgl_ars"]; ?></td>
                                <td scope="col"><?php echo $row_arisan["masuk_ars"]; ?></td>
                                <td scope="col"><?php echo $row_arisan["keluar_ars"]; ?></td>
                                <td scope="col"><?php echo $row_arisan["ket_ars"]; ?></td>
                                <td scope="col">

                                    <!-- BUTTON EDIT DATA  -->

                                    <div class="mb-1 row">
                                        <button type="button" class="btn btn-warning" style="background-color: #F5B17B; border: 1px solid #F5B17B; width: 95%;" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row_arisan["id_ars"]; ?>">Edit</button>
                                    </div>
                                    
                                    <!-- POPUP MODAL EDIT DATA  -->

                                    <div class="modal fade" id="modalEdit<?php echo $row_arisan["id_ars"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color:#BAC7A7;">
                                                <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="background-color:#E5E4CC;">
                                                        <input type="hidden" class="form-control" name="id_ars" value="<?php echo $row_arisan["id_ars"];?>">
                                                        <input type="hidden" class="form-control" name="idprd_ars" value="<?php echo $id_prd;?>">
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Jenis</label>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-select" aria-label="Default select example" name="jns_ars">
                                                                    <option value="<?php echo $row_arisan["jns_ars"];?>" selected><?php echo $row_arisan["jns_ars"];?></option>
                                                                    <option value="Arisan">Arisan</option>
                                                                    <option value="Donasi">Donasi</option>
                                                                    <option value="Biaya Lainnya">Biaya Lainnya</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Nama</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="nama_ars" value="<?php echo $row_arisan["nama_ars"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Tanggal</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="date" class="form-control" name="tgl_ars" value="<?php echo $row_arisan["tgl_ars"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Pemasukan</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="masuk_ars" value="<?php echo $row_arisan["masuk_ars"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                                <label for="staticEmail" class="form-label">Pengeluaran</label>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="keluar_ars" value="<?php echo $row_arisan["keluar_ars"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-4">
                                                            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                                                            </div>
                                                            <div class="col">
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ket_ars" value="<?php echo $row_arisan["ket_ars"];?>"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name ="btnEdit_arisan" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4;">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BUTTON HAPUS DATA  -->

                                    <div class="mb-1 row">
                                        <a 	href="halaman_home.php?btnHapus_arisan&id_ars=<?php echo $row_arisan["id_ars"];?>&idprd_ars=<?php echo $id_prd;?>" 
                                        onclick="return confirm('yakin ingin menghapus data?')"
                                        class="btn btn-danger" style="background-color: #EF7B7B; border: 1px solid #EF7B7B; width: 95%;">
                                            Hapus
                                        </a>
                                    </div>

                                    <!-- BUTTON DETAIL  -->

                                    <div class="mb-1 row">
                                        <?php if($row_arisan["jns_ars"] == "Arisan"){ ?>
                                        <a 	href="halaman_bayar.php?id_ars=<?php echo $row_arisan["id_ars"]; ?>" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4; width: 95%;">
                                        <?php }else if($row_arisan["jns_ars"] == "Donasi"){ ?>
                                        <a 	href="halaman_donasi.php?id_ars=<?php echo $row_arisan["id_ars"];?>" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4; width: 95%;">
                                        <?php }else{ ?>
                                        <a 	href="halaman_bayar.php" class="btn btn-success" style="background-color: #87A8A4; border: 1px solid #87A8A4; width: 95%; display:none;">
                                        <?php } ?>
                                            Pembayaran
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <tr>
                                <th></th>
                                <th style="font-size: 110%;">TOTAL</th>
                                <th></th>
                                <th></th>
                                <th style="font-size: 110%;">430000</th>
                                <th style="font-size: 110%;">110000</th>
                                <th style="font-size: 110%;">SALDO</th>
                                <th colspan="2" style="font-size: 110%;">320000</th>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    (function($bs) {
        const CLASS_NAME = 'has-child-dropdown-show';
        $bs.Dropdown.prototype.toggle = function(_orginal) {
            return function() {
                document.querySelectorAll('.' + CLASS_NAME).forEach(function(e) {
                    e.classList.remove(CLASS_NAME);
                });
                let dd = this._element.closest('.dropdown').parentNode.closest('.dropdown');
                for (; dd && dd !== document; dd = dd.parentNode.closest('.dropdown')) {
                    dd.classList.add(CLASS_NAME);
                }
                return _orginal.call(this);
            }
        }($bs.Dropdown.prototype.toggle);

        document.querySelectorAll('.dropdown').forEach(function(dd) {
            dd.addEventListener('hide.bs.dropdown', function(e) {
                if (this.classList.contains(CLASS_NAME)) {
                    this.classList.remove(CLASS_NAME);
                    e.preventDefault();
                }
                e.stopPropagation(); // do not need pop in multi level mode
            });
        });
    })(bootstrap);
</script>
</html>
<?php
require("library.php");
require("session.php");

$periode    = new Periode();
$arisan     = new Arisan();

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


require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = 
'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 style="align-text:center;">DAFTAR KEUANGAN PERIODE I</h3>
    <table style="margin: 0 auto;" id="table" border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NO</th>
            <th>Jenis</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Keterangan</th>
        </tr>';
        $i=1; 
        foreach($rows_arisan as $row_arisan):
$html .='<tr>
            <td>' . $i++ .'</td>
            <td>' . $row_arisan["jns_ars"] . '</td>
            <td>' . $row_arisan["nama_ars"] . '</td>
            <td>' . $row_arisan["tgl_ars"] . '</td>
            <td>' . $row_arisan["masuk_ars"] . '</td>
            <td>' . $row_arisan["keluar_ars"] . '</td>
            <td>' . $row_arisan["ket_ars"] . '</td>
        <tr>';
        endforeach;
$html .='<tr rowspan="2">
            <th colspan="4">TOTAL</th>
            <th>PEMASUKAN</th>
            <th>PENGELUARAN</th>
            <th>SALDO</th>
        </tr>
        <tr>
            <th colspan="4"></th>
            <th style="font-size: 110%;">430000</th>
            <th style="font-size: 110%;">110000</th>
            <th colspan="2" style="font-size: 110%;">320000</th>
        </tr>
    </table>
</body>
</html>';


$mpdf->WriteHTML($html);
$mpdf->Output();

?>

<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ciri.php');
include('classes/Jenis.php');
include('classes/Hewan.php');
include('classes/Template.php');

// Membuat objek Hewan
$hewan = new Hewan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Membuka koneksi ke database
$hewan->open();

// Inisialisasi variabel untuk menyimpan data
$data = null;

// Mengecek apakah terdapat parameter GET 'id'
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // Jika ada, ambil data hewan berdasarkan ID
        $hewan->getHewanById($id);
        $row = $hewan->getResult();

        // Menyiapkan data untuk ditampilkan dalam tampilan detail dan button edit serta hapus
        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['hewan_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['hewan_foto'] . '" class="img-thumbnail" alt="' . $row['hewan_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['hewan_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Populasi</td>
                                    <td>:</td>
                                    <td>' . $row['hewan_populasi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Nama Latin</td>
                                    <td>:</td>
                                    <td>' . $row['hewan_nama_latin'] . '</td>
                                </tr>
                                <tr>
                                    <td>Ciri</td>
                                    <td>:</td>
                                    <td>' . $row['ciri_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jenis</td>
                                    <td>:</td>
                                    <td>' . $row['jenis_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="form.php?id=' . $row['hewan_id'] . '"><button type="button" class="btn btn-success text-white">Edit Data</button></a>
                <a href="detail.php?hapus=' . $row['hewan_id'] .'"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

// Mengecek apakah terdapat parameter GET 'hapus'
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    if($id > 0){
        // Jika ada, hapus data hewan berdasarkan ID
        if($hewan->deleteData($id) > 0){
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else{
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

// Menutup koneksi ke database
$hewan->close();

// Membuat objek Template untuk menampilkan tampilan detail
$detail = new Template('templates/skindetail.html');

// Mengganti nilai variabel pada template dengan data yang sudah diproses
$detail->replace('DATA_DETAIL_HEWAN', $data);

// Menampilkan hasil template
$detail->write();

<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Ciri.php');
include('classes/Jenis.php');
include('classes/Hewan.php');
include('classes/Template.php');

// Membuat objek Hewan, Ciri, dan Jenis
$hewan = new Hewan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ciri = new Ciri($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Membuka koneksi ke database untuk setiap objek
$hewan->open();
$ciri->open();
$jenis->open();

// Inisialisasi variabel untuk opsi ciri dan jenis, serta variabel lainnya
$ciri_options = "";
$jenis_options = "";
$selected = "";
$gambar = "";
$view = new Template('templates/skinform.html');

// cek id
if (!isset($_GET['id'])) {
    // Jika terdapat pengiriman data melalui metode POST
    if (isset($_POST['submit'])) {
        // Menambahkan data hewan
        if ($hewan->addData($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'index.php';
            </script>";
        }
    }

    // Mendapatkan daftar ciri dari database dan menyiapkan opsi ciri
    $ciri->getCiri();
    while ($cir = $ciri->getResult()) {
        $ciri_options .= "<option value=" . $cir['ciri_id'] . ">" . $cir['ciri_nama'] . "</option>";
    }

    // Mendapatkan daftar jenis dari database dan menyiapkan opsi jenis
    $jenis->getJenis();
    while ($jen = $jenis->getResult()) {
        $jenis_options .= "<option value=" . $jen['jenis_id'] . ">" . $jen['jenis_nama'] . "</option>";
    }

    // Mengatur tombol dan tindakan sebagai 'Tambah' karena sedang dalam mode tambah
    $btn = 'Tambah';
    $action = 'Tambah';
}

// cek id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // Jika ID valid, ambil data hewan berdasarkan ID
        $hewan->getHewanById($id);
        $row = $hewan->getResult();
        $picToUpdate = $row['hewan_foto'];
        $nameToUpdate = $row['hewan_nama'];
        $populasiToUpdate = $row['hewan_populasi'];
        $namaLatinToUpdate = $row['hewan_nama_latin'];
        $ciriToUpdate = $row['ciri_id'];
        $jenisToUpdate = $row['jenis_id'];

        // Jika terdapat pengiriman data melalui metode POST (untuk mengedit data)
        if (isset($_POST['submit'])) {
            // Mengupdate data hewan
            if ($hewan->updateData($id, $_POST, $_FILES, $picToUpdate) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
            }
        }

        // Mengatur tombol dan tindakan sebagai 'Edit' karena sedang dalam mode edit
        $btn = 'Edit';
        $action = 'Edit';

        // Mengisi nilai default pada form dengan data yang akan diubah
        $view->replace('DATA_VALUE_NAME', $nameToUpdate);
        $view->replace('DATA_VALUE_POPULASI', $populasiToUpdate);
        $view->replace('DATA_VALUE_NAMA_LATIN', $namaLatinToUpdate);
        
        // Mendapatkan daftar ciri dari database dan menyiapkan opsi ciri
        $ciri->getCiri();
        while ($cir = $ciri->getResult()) {
            $selected = ($ciriToUpdate == $cir['ciri_id'] ? 'selected' : '');
            $ciri_options .= "<option value=" . $cir['ciri_id'] . " " . $selected .">" . $cir['ciri_nama'] . "</option>";
        }

        // Mendapatkan daftar jenis dari database dan menyiapkan opsi jenis
        $jenis->getJenis();
        while ($jen = $jenis->getResult()) {
            $selected = ($jenisToUpdate == $jen['jenis_id'] ? 'selected' : '');
            $jenis_options .= "<option value=" . $jen['jenis_id'] . " " . $selected .">" . $jen['jenis_nama'] . "</option>";
        }

        // Menyiapkan tampilan gambar yang akan diubah
        $gambar .= '<div class="col mb-3">
            <img src="assets/images/' . $picToUpdate . '" width="124" height="124">
        </div>';
    }
}

// Menutup koneksi ke database untuk setiap objek
$hewan->close();
$ciri->close();
$jenis->close();

// Mengganti placeholder pada template dengan nilai-nilai yang sudah disiapkan
$view->replace('DATA_ACTION', $action);
$view->replace('DATA_JENIS_OPTIONS', $jenis_options);
$view->replace('DATA_GAMBAR', $gambar);
$view->replace('DATA_CIRI_OPTIONS', $ciri_options);
$view->replace('DATA_BUTTON', $btn);

// Menampilkan tampilan yang sudah diproses
$view->write();

// Komentar: Kode di atas digunakan untuk mengatur logika penambahan dan pengeditan data hewan serta menyiapkan form sesuai dengan mode yang sedang berjalan.

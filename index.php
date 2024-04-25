<?php
// Saya Alfen Fajri Nurulhaq 2201431 TP3 dalam Mata Kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.
include('config/db.php');
include('classes/DB.php');
include('classes/Ciri.php');
include('classes/Jenis.php');
include('classes/Hewan.php');
include('classes/Template.php');

// Membuat objek Hewan
$listHewan = new Hewan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Membuka koneksi ke database
$listHewan->open();

// Mendapatkan data hewan dengan join tabel
$listHewan->getHewanJoin();

// Mengecek apakah tombol pencarian ("btn-search") ditekan
if (isset($_POST['btn-search'])) {
    // Jika ya, melakukan pencarian hewan berdasarkan kata kunci yang dimasukkan
    $listHewan->searchHewan($_POST['search']);
}
// Jika tombol filter "btn-asc" ditekan
else if(isset($_POST['btn-asc'])){
    // Melakukan pengurutan data secara ascending
    $listHewan->filterAsc();    
}
// Jika tombol filter "btn-desc" ditekan
else if(isset($_POST['btn-desc'])){
    // Melakukan pengurutan data secara descending
    $listHewan->filterDesc();    
}
// Jika tombol filter "btn-default" ditekan atau tidak ada aksi yang dipilih
else if(isset($_POST['btn-default'])){
    // Mengambil data hewan dengan join tabel tanpa filter
    $listHewan->getHewanJoin();    
}

// Inisialisasi variabel untuk menyimpan data
$data = null;

// Mengambil hasil data hewan yang telah diproses
while ($row = $listHewan->getResult()) {
    // Menambahkan data ke dalam struktur HTML untuk ditampilkan
    $data .= '<div class="col gx-2 gy-2 justify-content-center">' .
        '<div class="card pt-4 px-2 hewan-thumbnail">
        <a href="detail.php?id=' . $row['hewan_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['hewan_foto'] . '" class="card-img-top" alt="' . $row['hewan_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text hewan-name text-center my-0">' . $row['hewan_nama'] . '</p>
                <p class="card-text ciri-name text-center my-0">' . $row['ciri_nama'] . '</p>
                <p class="card-text hewan-nama-latin text-center fst-italic fw-bold">' . $row['hewan_nama_latin'] . '</p>
                <p class="card-text jenis-name text-center my-0">' . $row['jenis_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// Menutup koneksi ke database
$listHewan->close();

// Membuat objek Template untuk menampilkan tampilan
$home = new Template('templates/skin.html');

// Mengganti nilai variabel pada template dengan data yang sudah diproses
$home->replace('DATA_HEWAN', $data);

// Menampilkan hasil template
$home->write();

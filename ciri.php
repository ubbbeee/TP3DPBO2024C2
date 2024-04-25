<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Ciri.php');
include('classes/Template.php');

// Membuat objek Ciri dan membuka koneksi database
$ciri = new Ciri($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$ciri->open();

// Mengambil data ciri
$ciri->getCiri();

// Mengecek apakah tombol pencarian ("btn-search") ditekan
if (isset($_POST['btn-search'])) {
    // Jika ya, melakukan pencarian berdasarkan kata kunci yang dimasukkan
    $ciri->searchCiri($_POST['search']);
}
// Jika tombol filter "btn-asc" ditekan
else if(isset($_POST['btn-asc'])){
    // Melakukan pengurutan data secara ascending
    $ciri->filterAsc();    
}
// Jika tombol filter "btn-desc" ditekan
else if(isset($_POST['btn-desc'])){
    // Melakukan pengurutan data secara descending
    $ciri->filterDesc();    
}
// Jika tombol filter "btn-default" ditekan atau tidak ada aksi yang dipilih
else if(isset($_POST['btn-default'])){
    // Mengambil data ciri secara default
    $ciri->getCiri();    
}

// Jika tidak ada parameter "id" yang diterima
if (!isset($_GET['id'])) {
    // Jika tombol submit ("submit") ditekan
    if (isset($_POST['submit'])) {
        // Jika nama ciri tidak kosong, tambahkan data ciri baru
        if (!empty($_POST['name'])) {
            if ($ciri->addCiri($_POST) > 0) {
                // Tampilkan pesan sukses jika data berhasil ditambahkan
                echo "<script>
                    alert('Data berhasil ditambah!');
                    document.location.href = 'ciri.php';
                </script>";
            } else {
                // Tampilkan pesan gagal jika data gagal ditambahkan
                echo "<script>
                    alert('Data gagal ditambah!');
                    document.location.href = 'ciri.php';
                </script>";
            }
        } else {
            // Tampilkan pesan jika nama ciri kosong
            echo "<script>
                alert('Data tidak boleh kosong!');
                document.location.href = 'ciri.php';
            </script>";
        }
    }

    // Set judul dan teks tombol untuk form tambah data
    $btn = 'Tambah';
    $title = 'Tambah';
}

// Membuat objek Template untuk menampilkan tampilan
$view = new Template('templates/skintabel.html');

// Menentukan judul utama tabel
$mainTitle = 'Ciri';

// Menentukan header tabel
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Ciri</th>
<th scope="row">Action</th>
</tr>';

// Menginisialisasi variabel data dan nomor baris
$data = null;
$no = 1;

// Mengambil data ciri dan menambahkannya ke dalam tabel
while ($cir = $ciri->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $cir['ciri_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="ciri.php?id=' . $cir['ciri_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="ciri.php?hapus=' . $cir['ciri_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Jika ada parameter "id" yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // Jika tombol submit ("submit") ditekan
        if (isset($_POST['submit'])) {
            // Jika nama ciri tidak kosong, update data ciri
            if (!empty($_POST['name'])) {
                if ($ciri->updateCiri($id, $_POST) > 0) {
                    // Tampilkan pesan sukses jika data berhasil diubah
                    echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'ciri.php';
                </script>";
                } else {
                    // Tampilkan pesan gagal jika data gagal diubah
                    echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'ciri.php';
                </script>";
                }
            }
            else {
                // Tampilkan pesan jika nama ciri kosong
                echo "<script>
                    alert('Data tidak boleh kosong!');
                    document.location.href = 'ciri.php';
                </script>";
            }
        }

        // Mengambil data ciri berdasarkan ID untuk proses pengeditan
        $ciri->getCiriById($id);
        $row = $ciri->getResult();

        // Mengambil data yang akan di-update
        $dataUpdate = $row['ciri_nama'];
        $btn = 'Edit';
        $title = 'Edit';

        // Mengganti nilai variabel pada template dengan data yang akan di-update
        $view->replace('DATA_VALUE_UPDATE', $dataUpdate);
    }
}

// Jika ada parameter "hapus" yang diterima
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Menghapus data ciri
        if ($ciri->deleteCiri($id) > 0) {
            // Tampilkan pesan sukses jika data berhasil dihapus
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'ciri.php';
            </script>";
        } else {
            // Tampilkan pesan gagal jika data gagal dihapus
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'ciri.php';
            </script>";
        }
    }
}

// Menutup koneksi database
$ciri->close();

// Mengganti nilai variabel pada template dengan data yang sudah diproses
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL', $data);

// Menampilkan hasil template
$view->write();

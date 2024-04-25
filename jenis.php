<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Jenis.php');
include('classes/Template.php');

// Membuat objek Jenis dan membuka koneksi database
$jenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis->open();

// Mengambil data jenis
$jenis->getJenis();

// Mengecek apakah tombol pencarian ("btn-search") ditekan
if (isset($_POST['btn-search'])) {
    // Jika ya, melakukan pencarian berdasarkan kata kunci yang dimasukkan
    $jenis->searchJenis($_POST['search']);
}
// Jika tombol filter "btn-asc" ditekan
else if(isset($_POST['btn-asc'])){
    // Melakukan pengurutan data secara ascending
    $jenis->filterAsc();    
}
// Jika tombol filter "btn-desc" ditekan
else if(isset($_POST['btn-desc'])){
    // Melakukan pengurutan data secara descending
    $jenis->filterDesc();    
}
// Jika tombol filter "btn-default" ditekan atau tidak ada aksi yang dipilih
else if(isset($_POST['btn-default'])){
    // Mengambil data jenis secara default (tanpa filter)
    $jenis->getJenis();    
}

// Jika tidak ada parameter "id" yang diterima
if (!isset($_GET['id'])) {
    // Jika tombol submit ("submit") ditekan
    if (isset($_POST['submit'])) {
        // Jika nama jenis tidak kosong, tambahkan data jenis baru
        if (!empty($_POST['name'])) {
            if ($jenis->addJenis($_POST) > 0) {
                // Tampilkan pesan sukses jika data berhasil ditambahkan
                echo "<script>
                    alert('Data berhasil ditambah!');
                    document.location.href = 'jenis.php';
                </script>";
            } else {
                // Tampilkan pesan gagal jika data gagal ditambahkan
                echo "<script>
                    alert('Data gagal ditambah!');
                    document.location.href = 'jenis.php';
                </script>";
            }
        } else {
            // Tampilkan pesan jika nama jenis kosong
            echo "<script>
                alert('Data tidak boleh kosong!');
                document.location.href = 'jenis.php';
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
$mainTitle = 'Jenis';

// Menentukan header tabel
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Jenis</th>
<th scope="row">Action</th>
</tr>';

// Menginisialisasi variabel data dan nomor baris
$data = null;
$no = 1;

// Mengambil data jenis dan menambahkannya ke dalam tabel
while ($jen = $jenis->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $jen['jenis_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="jenis.php?id=' . $jen['jenis_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="jenis.php?hapus=' . $jen['jenis_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
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
            // Jika nama jenis tidak kosong, update data jenis
            if (!empty($_POST['name'])) {
                if ($jenis->updateJenis($id, $_POST) > 0) {
                    // Tampilkan pesan sukses jika data berhasil diubah
                    echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'jenis.php';
                </script>";
                } else {
                    // Tampilkan pesan gagal jika data gagal diubah
                    echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'jenis.php';
                </script>";
                }
            }
            else {
                // Tampilkan pesan jika nama jenis kosong
                echo "<script>
                    alert('Data tidak boleh kosong!');
                    document.location.href = 'jenis.php';
                </script>";
            }
        }

        // Mengambil data jenis berdasarkan ID untuk proses pengeditan
        $jenis->getJenisById($id);
        $row = $jenis->getResult();

        // Mengambil data yang akan di-update
        $dataUpdate = $row['jenis_nama'];
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
        // Menghapus data jenis
        if ($jenis->deleteJenis($id) > 0) {
            // Tampilkan pesan sukses jika data berhasil dihapus
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jenis.php';
            </script>";
        } else {
            // Tampilkan pesan gagal jika data gagal dihapus
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'jenis.php';
            </script>";
        }
    }
}

// Menutup koneksi database
$jenis->close();

// Mengganti nilai variabel pada template dengan data yang sudah diproses
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL', $data);

// Menampilkan hasil template
$view->write();


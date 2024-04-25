<?php

class Hewan extends DB
{
    // Fungsi untuk mengambil data hewan beserta data ciri dan jenisnya dengan menggunakan JOIN
    function getHewanJoin()
    {
        $query = "SELECT * FROM hewan JOIN ciri ON hewan.ciri_id=ciri.ciri_id JOIN jenis ON hewan.jenis_id=jenis.jenis_id ORDER BY hewan.hewan_id";

        return $this->execute($query);
    }

    // Fungsi untuk mengambil semua data dari tabel hewan
    function getHewan()
    {
        $query = "SELECT * FROM hewan";
        return $this->execute($query);
    }
     // Fungsi untuk mengambil data hewan berdasarkan ID, termasuk data ciri dan jenisnya dengan menggunakan JOIN
    function getHewanById($id)
    {
        $query = "SELECT * FROM hewan JOIN ciri ON hewan.ciri_id=ciri.ciri_id JOIN jenis ON hewan.jenis_id=jenis.jenis_id WHERE hewan_id=$id";
        return $this->execute($query);
    }
    // Fungsi untuk mencari data hewan berdasarkan keyword, termasuk nama hewan, nama ciri, nama jenis, dan nama Latin
    function searchHewan($keyword)
    {
        $query = "SELECT * FROM hewan JOIN ciri ON hewan.ciri_id=ciri.ciri_id JOIN jenis ON hewan.jenis_id=jenis.jenis_id WHERE hewan_nama LIKE '%$keyword%' OR ciri_nama LIKE '%$keyword%' OR jenis_nama LIKE '%$keyword%' OR hewan_nama_latin LIKE '%$keyword%'";
        return $this->execute($query);
    }
    // Fungsi untuk mengambil data hewan dengan mengurutkan secara ascending berdasarkan nama hewan
    function filterAsc(){
        $query = "SELECT * FROM hewan JOIN ciri ON hewan.ciri_id=ciri.ciri_id JOIN jenis ON hewan.jenis_id=jenis.jenis_id ORDER BY hewan_nama ASC";
        return $this->execute($query);
    }
    // Fungsi untuk mengambil data hewan dengan mengurutkan secara descending berdasarkan nama hewan
    function filterDesc(){
        $query = "SELECT * FROM hewan JOIN ciri ON hewan.ciri_id=ciri.ciri_id JOIN jenis ON hewan.jenis_id=jenis.jenis_id ORDER BY hewan_nama DESC";
        return $this->execute($query);
    }  
    // Fungsi untuk menambahkan data hewan ke dalam tabel, termasuk nama file foto, nama, populasi, nama Latin, ID ciri, dan ID jenis
    function addData($data, $file)
    {  
        $temp = $file['hewan_foto']['tmp_name'];
        $filename = $file['hewan_foto']['name'];

        $folder = "assets/images/".$filename;
        move_uploaded_file($temp, $folder);
        
        $name = $data['name'];
        $populasi = $data['populasi'];
        $nama_latin = $data['nama_latin'];
        $ciri = $data['ciri'];
        $jenis = $data['jenis'];

        $query = "INSERT INTO hewan VALUES('', '$filename', '$name', '$populasi','$nama_latin', '$ciri', '$jenis')";
        return $this->executeAffected($query);
    }
    // Fungsi untuk mengupdate data hewan berdasarkan ID, termasuk foto, nama, populasi, nama Latin, ID ciri, dan ID jenis
    function updateData($id, $data, $file, $image)
    {
        $temp = $file['hewan_foto']['tmp_name'];
        $filename = $file['hewan_foto']['name'];

        if(empty($filename)){
            $filename = $image;
        }

        $folder = "assets/images/".$filename;
        move_uploaded_file($temp, $folder);
        
        $name = $data['name'];
        $populasi = $data['populasi'];
        $nama_latin = $data['nama_latin'];
        $ciri = $data['ciri'];
        $jenis = $data['jenis'];
        
        $query = "UPDATE hewan SET hewan_foto='$filename', hewan_nama='$name', hewan_populasi='$populasi' ,hewan_nama_latin='$nama_latin', ciri_id='$ciri', jenis_id='$jenis' WHERE hewan_id=$id";
        return $this->executeAffected($query);
    }
    // Fungsi untuk menghapus data hewan berdasarkan ID
    function deleteData($id)
    {
        $query = "DELETE FROM hewan WHERE hewan_id=$id";
        return $this->executeAffected($query);
    }
}
<?php

class Ciri extends DB
{
    //getCiri untuk mengambil semua data dari ciri
    function getCiri()
    {
        $query = "SELECT * FROM ciri";
        return $this->execute($query);
    }

    // getCiriById untuk mengambil suatu data dari ciri berdasarkan id cirinya
    function getCiriById($id)
    {
        $query = "SELECT * FROM ciri WHERE ciri_id=$id";
        return $this->execute($query);
    }

    //untuk menambah data ciri
    function addCiri($data)
    {
        $name = $data['name'];
        $query = "INSERT INTO ciri VALUES('', '$name')";
        return $this->executeAffected($query);
    }

    //untuk edit suatu data ciri berdasarkan id
    function updateCiri($id, $data)
    {
        $name = $data['name'];
        $query = "UPDATE ciri SET ciri_nama='$name' WHERE ciri_id=$id";
        return $this->executeAffected($query);
    }

    // untuk hapus suatu data ciri berdasarkan id
    function deleteCiri($id)
    {
        $query = "DELETE FROM ciri WHERE ciri_id=$id";
        return $this->executeAffected($query);
    }

    //untuk mencari data ciri berdasarkan inputan nama ciri
    function searchCiri($keyword)
    {
        $query = "SELECT * FROM ciri WHERE ciri_nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    //untuk sorting ciri secara ascending
    function filterAsc(){
        $query = "SELECT * FROM ciri ORDER BY ciri_nama ASC";
        return $this->execute($query);
    }

    //untuk sorting ciri secara descending
    function filterDesc(){
        $query = "SELECT * FROM ciri ORDER BY ciri_nama DESC";
        return $this->execute($query);
    }
}
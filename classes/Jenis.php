<?php
//untuk class Jenis ini sendiri kurang lebih sama dengan class Ciri isinya query query hanya untuk jenis
class Jenis extends DB
{

    function getJenis()
    {
        $query = "SELECT * FROM jenis";
        return $this->execute($query);
    }

    function getJenisById($id)
    {
        $query = "SELECT * FROM jenis WHERE jenis_id=$id";
        return $this->execute($query);
    }

    function addJenis($data)
    {
        $name = $data['name'];
        $query = "INSERT INTO jenis VALUES('', '$name')";
        return $this->executeAffected($query);
    }

    function updateJenis($id, $data)
    {
        $name = $data['name'];
        $query = "UPDATE jenis SET jenis_nama='$name' WHERE jenis_id=$id";
        return $this->executeAffected($query);
    }

    function deleteJenis($id)
    {
        $query = "DELETE FROM jenis WHERE jenis_id=$id";
        return $this->executeAffected($query);
    }

    function searchJenis($keyword)
    {
        $query = "SELECT * FROM jenis WHERE jenis_nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function filterAsc(){
        $query = "SELECT * FROM jenis ORDER BY jenis_nama ASC";
        return $this->execute($query);
    }

    function filterDesc(){
        $query = "SELECT * FROM jenis ORDER BY jenis_nama DESC";
        return $this->execute($query);
    }
}
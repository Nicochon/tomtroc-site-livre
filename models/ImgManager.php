<?php

/**
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class ImgManager extends AbstractEntityManager
{
    public function getImgByOwnerId(int $owner_Id)
    {
        $sql = "SELECT * FROM img WHERE owner_Id = :owner_Id";
        $result = $this->db->query($sql, ['owner_Id' => $owner_Id]);
        $img = $result->fetch();

        if (!empty($img)) {
            return new Img($img);
        }
        return null;
    }

    public function addImg($name, $owner_Id, $type)
    {
        $sql = "INSERT INTO img (name, owner_Id, type) VALUES (:name, :owner_Id, :type)";
        $this->db->query($sql, [
            'name' => $name,
            'owner_Id' => $owner_Id,
            'type' => $type,
        ]);
    }

    public function deleteImg(int $id)
    {
        $sql = "DELETE FROM img WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function lastIdInsert ()
    {
        $sql = "SELECT MAX( id )  AS idMax FROM img";
        $result = $this->db->query($sql);
        $img = $result->fetch();

        if ($img['idMax'] === null){
            return $img = 1;
        } else {
            return $img['idMax'];
        }
    }

    public function deleteImgByOwner(int $owner_Id)
    {
        $sql = "DELETE FROM img WHERE owner_Id = :owner_Id";
        $this->db->query($sql, ['owner_Id' => $owner_Id]);
    }
}
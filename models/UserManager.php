<?php

/**
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class UserManager extends AbstractEntityManager
{
    /**
     * Récupère un user par son login.
     * @param string $login
     * @return ?User
     */
    public function getUserByPseudo(string $pseudo) : ?User
    {
        $sql = "SELECT * FROM user WHERE pseudo = :pseudo";
        $result = $this->db->query($sql, ['pseudo' => $pseudo]);

        $userPseudo = $result->fetch();

        if ($userPseudo) {
            return new User($userPseudo);
        }
        return null;
    }

    public function getUserById(int $id) : ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);

        $userId = $result->fetch();

        if ($userId) {
            return new User($userId);
        }
        return null;
    }

    public function getUserByEmail(string $email) : ?User
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);

        $userEmail = $result->fetch();

        if ($userEmail) {
            return new User($userEmail);
        }
        return null;
    }

    public function addUser(User $user) : void
    {
        $sql = "INSERT INTO user (pseudo, email, password, dateUser) VALUES (:pseudo, :email, :password, NOW())";
        $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
        ]);
    }

    public function updateProfilePicture(User $user)
    {
        $sql = "UPDATE user SET imgName = :imgName WHERE id = :id";
        $this->db->query($sql, [
            'imgName' => $user->getImgName(),
            'id' => $user->getIdUser(),
        ]);
    }

    public function updateInfoUser(User $user)
    {
        $sql = "UPDATE user SET password = :password, pseudo = :pseudo, email = :email WHERE id = :id";
        $this->db->query($sql, [
            'password' => $user->getPassword(),
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'id' => $user->getIdUser(),
        ]);
    }
}
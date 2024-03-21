<?php

/**
 * Entité User : un user est défini par son id, un login, un password, un email, une photo.
 */
class User extends AbstractEntity
{
    private string $pseudo;
    private string $password;
    private string $email;
    private int $idUser;
    private ?DateTime $dateUser = null;
    private ?string $imgName;

    /**
     * Setter pour le login.
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo) : void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le login.
     * @return string
     */
    public function getPseudo() : string
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * Setter pour l'email.
     * @param string $email
     */
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    /**
     * Getter pour l'email.
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUser
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateUser(string|DateTime $dateUser, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($dateUser)) {
            $dateUser = DateTime::createFromFormat($format, $dateUser);
        }
        $this->dateUser = $dateUser;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDateUser() : ?DateTime
    {
        return $this->dateUser;
    }

    /**
     * Setter pour le id.
     * @param string $pseudo
     */
    public function setIdUser(int $idUser) : void
    {
        $this->id = $idUser;
    }

    /**
     * Getter pour le id.
     * @return string
     */
    public function getIdUser() : int
    {
        return $this->id;
    }

    /**
     * Setter pour la photo de profil.
     * @param string $profilePicture
     */
    public function setImgName(string $imgName) : void
    {
        $this->imgName = $imgName;
    }

    /**
     * Getter pour la photo de profil.
     * @return string
     */
    public function getImgName() : string
    {
        return $this->imgName;
    }

}
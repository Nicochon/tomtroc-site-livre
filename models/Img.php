<?php

/**
 * Entité User : un user est défini par son id, un login, un password, un email, une photo.
 */
class Img extends AbstractEntity
{
    private string $name;
    private string $owner_Id;
    private string $type;
    private int $idImg;

    public function __construct(array $data) {
        $this->idImg = $data['id'];
        $this->name = $data['name'];
        $this->owner_Id = $data['owner_Id'];
        $this->type = $data['type'];
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getOwnerId(): string
    {
        return $this->owner_Id;
    }

    public function setOwnerId(string $owner_Id): void
    {
        $this->owner_Id = $owner_Id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getIdImg(): int
    {
        return $this->idImg;
    }

    public function setIdImg(int $idImg): void
    {
        $this->idImg = $idImg;
    }
}


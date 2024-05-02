<?php

/**
 * Entité User : un user est défini par son id, un login, un password, un email, une photo.
 */
class message extends AbstractEntity
{
    private int $id_message;
    private string $content;
    private int $id_owner;
    private string $date;

    public function getIdMessage(): int
    {
        return $this->id_message;
    }

    public function setIdMessage(int $id_message): void
    {
        $this->id_message = $id_message;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getIdOwner(): int
    {
        return $this->id_owner;
    }

    public function setIdOwner(int $id_owner): void
    {
        $this->id_owner = $id_owner;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}

<?php

/**
 * Entité User : un user est défini par son id, un login, un password, un email, une photo.
 */
class Book extends AbstractEntity
{
    private int $idBook;
    private string $title;
    private string $author;
    private int $owner_Id;
    private string $content;

    public function __construct( array $data = [] ) {
        parent::__construct( $data );
    }
    public function getIdBook(): int
    {
        return $this->idBook;
    }

    public function setIdBook(int $idBook): void
    {
        $this->idBook = $idBook;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getOwnerId(): int
    {
        return $this->owner_Id;
    }

    public function setOwnerId(int $owner_Id): void
    {
        $this->owner_Id = $owner_Id;
    }

    public function getContent(int $length = -1): string
    {
        if ($length > 0) {
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
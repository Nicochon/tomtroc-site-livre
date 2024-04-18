<?php

/**
 * Entité User : un user est défini par son id, un login, un password, un email, une photo.
 */
class Book extends AbstractEntity
{
    private int $id_Book;
    private string $title;
    private string $author;
    private int $owner_Id;
    private string $content;
    private string $status;

    public function __construct( array $data = [] ) {
        parent::__construct( $data );
    }

    /**
     * Getter pour le id_book.
     * @return int
     */
    public function getIdBook(): int
    {
        return $this->id_Book;
    }

    /**
     * Setter pour le id_book.
     * @param int $id_Book
     */
    public function setIdBook(int $id_Book): void
    {
        $this->id_Book = $id_Book;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Setter pour l'auteur.
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * Getter pour le l'owner_id.
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->owner_Id;
    }

    /**
     * Setter pour l'owner_id.
     * @param int $owner_Id
     */
    public function setOwnerId(int $owner_Id): void
    {
        $this->owner_Id = $owner_Id;
    }

    /**
     * Getter pour le contenu.
     * @param int $length
     * @return string
     */
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

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter pour le statut.
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Setter pour statut.
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
<?php

/**
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class bookManager extends AbstractEntityManager
{
    /**
     * Get all books
     */
    public function getAllBooks()
    {
        $sql = "SELECT * FROM book";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }

        return $books;
    }

    /**
     * Get book by id
     */
    public function getBookById(int $id) : ?Book
    {
        $sql = "SELECT * FROM book WHERE id_book = :id_book";
        $result = $this->db->query($sql, ['id_book' => $id]);

        $bookId = $result->fetch();

        if ($bookId) {
            return new Book($bookId);
        }

        return null;
    }

    /**
     * get books by owner
     */
    public function getBooksByOwner(int $owner_Id)
    {
        $sql = "SELECT * FROM book WHERE owner_Id = :owner_Id order by date desc ";
        $result = $this->db->query($sql, ['owner_Id' => $owner_Id]);

        $book = $result->fetchAll();
        if (!empty($book)) {

            return $book;
        }

        return null;
    }

    /**
     * Get last books
     */
    public function getLastBooks()
    {
        $sql = "SELECT * FROM book ORDER BY date DESC LIMIT 5";
        $result = $this->db->query($sql);

        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }

        return $books;
    }

    /**
     * Add book
     */
    public function addBook($title, $author, $owner_Id, $content, $availability)
    {
        $sql = "INSERT INTO book (title, author, owner_Id, content, date, status) VALUES (:title, :author, :owner_Id, :content, NOW(), :status)";
        $this->db->query($sql, [
            'title' => $title,
            'author' => $author,
            'owner_Id' => $owner_Id,
            'content' => $content,
            'status' => $availability
        ]);
    }

    /**
     * Update book
     */
    public function updateBook($id_Book, $title, $author, $content, $availability)
    {
        $sql = "UPDATE book SET title = :title, author = :author, content = :content, status = :status WHERE id_book = :id_book";
        $this->db->query($sql, [
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'status' => $availability,
            'id_book' => $id_Book,
        ]);
    }

    /**
     * Update picture book
     */
    public function updatePictureBook(Book $book)
    {
        $sql = "UPDATE user SET imgName = :imgName WHERE id = :id";
        $this->db->query($sql, [
            'imgName' => $book->getPhotoName(),
            'id' => $book->getIdBook(),
        ]);
    }

    /**
     * Delete book
     */
    public function deleteBook($id_book)
    {
        $sql = "DELETE FROM book WHERE id_book = :id_book";
        $this->db->query($sql, [
            'id_book' => $id_book,
        ]);
    }


}
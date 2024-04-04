<?php

/**
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class bookManager extends AbstractEntityManager
{
    public function getAllBook()
    {
        $sql = "SELECT * FROM book";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }
    public function getBookById(int $id) : ?User
    {
        $sql = "SELECT * FROM book WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);

        $bookId = $result->fetch();

        if ($bookId) {
            return new User($bookId);
        }
        return null;
    }

    public function getBooksByOwner(int $owner_Id)
    {
        $sql = "SELECT * FROM book WHERE owner_Id = :owner_Id";
        $result = $this->db->query($sql, ['owner_Id' => $owner_Id]);

        $book = $result->fetchAll();
        if (!empty($book)) {

            return $book;
        }
        return null;
    }



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

    public function updatePicture(Book $book)
    {
        $sql = "UPDATE user SET imgName = :imgName WHERE id = :id";
        $this->db->query($sql, [
            'imgName' => $book->getPhotoName(),
            'id' => $book->getIdBook(),
        ]);
    }


}
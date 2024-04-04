<?php

class HomeController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $books = $this->getLastBook();
        $view = new View("Accueil");
        $view->render("home", [
            'books' => $books
        ]);
    }

    public function getLastBook()
    {
        $userManger = new UserManager();
        $bookManager = new BookManager();
        $booksData = $bookManager->getLastBooks();

        $books = [];

        foreach ($booksData as $bookData){
            $books[] = [
                'title' => $bookData->getTitle(),
                'author' => $bookData->getAuthor(),
                'owner' => $userManger->getUserById($bookData->getOwnerId()),
            ];
        }

        return $books;

    }
}
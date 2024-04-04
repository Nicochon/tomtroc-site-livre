<?php

class BookController
{
    public function showBook()
    {
        $view = new View("Book");
//        $view->render("book");
    }

    public function displayAddBookForm()
    {
        $view = new View("AddBookForm");
        $view->render("addBookForm");
    }

    public function addBook()
    {
        $title = htmlspecialchars(Utils::request("title"));
        $author = htmlspecialchars(Utils::request("author"));
        $owner_Id = $_SESSION['idUser'];
        $description = htmlspecialchars(Utils::request("textarea"));
        $availability = Utils::request("availability");

        $bookManager = new BookManager();
        $bookManager->addBook($title, $author, $owner_Id, $description, $availability);

        $this->addImgBook($owner_Id);
    }

    public function addImgBook($owner_Id)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $bookManager = new BookManager();
            $imgManager = new ImgManager();
            $allBookOwner = $bookManager->getBooksByOwner($owner_Id);
            $lastBook = end($allBookOwner);
            $type = 'book';

            $fileExist = Utils::checkIfPhotoExist($lastBook['id']);

            if (!empty($fileExist)) {
                $oldFileName = $fileExist[0]['name'];
                unlink(ROOT_FS . '/views/img/' . $type . '/' . $oldFileName);
                $imgManager->deleteImg($fileExist[0]['id']);
            }

            if ($imgManager->lastIdInsert() === 1) {
                $newImgId = $imgManager->lastIdInsert();
            } else {
                $newImgId = $imgManager->lastIdInsert() + 1;
            }

            $newFileName = $newImgId . '_photoBook' . '.' . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            $imgManager->addImg($newFileName, $lastBook['id'], $type);

            Utils::uploadPicture($type, $newFileName);

            $adminController = new AdminController();
            $adminController->showAdmin();
        }
    }

    public function getBookInfo()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $bookManager = new BookManager;
        $allData = $bookManager->getBooksByOwner($userdata->getIdUser());
        $allBooksOwner = [];

        $imgManager = new ImgManager();

        if($allData != null){
            foreach ($allData as $data) {
                $allBooksOwner[] = [
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'content' => Utils::limitContentLenght($data['content']),
                    'availability' => $data['status'],
                    'img' => $imgManager->getImgByOwnerId($data['id'])->getName(),
                ];
            }
        }
        return $allBooksOwner;
    }
}
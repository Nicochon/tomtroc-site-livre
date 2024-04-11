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

    public function displayUpdateBookForm()
    {
        $bookManager = new BookManager;
        $imgManager = new ImgManager();
        $bookData = $bookManager->getBookById(Utils::protectGet($_GET['id']));
        $imgData = $imgManager->getImgByOwnerId(Utils::protectGet($_GET['id']));

        $book = [
            'id' => $bookData->getIdBook(),
            'title' => $bookData->getTitle(),
            'author' => $bookData->getAuthor(),
            'content' => $bookData->getContent(),
            'status' => $bookData->getStatus()
        ];

        $img = [
            'name' => $imgData->getName()
        ];

        $view = new View("updateBookForm");
        $view->render("updateBookForm",[
            'bookInfo' => $book,
            'img' => $img
        ]);
    }

    public function displayDeleteBookVerification(){
        $id_book = Utils::protectGet($_GET['id']);

        $view = new View("deleteBook");
        $view->render("deleteBook",[
            'id_book' => $id_book,
        ]);
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

            $fileExist = Utils::checkIfPhotoExist($lastBook['id_Book']);

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
            $imgManager->addImg($newFileName, $lastBook['id_Book'], $type);

            Utils::uploadPicture($type, $newFileName);

            $this->displayAddBookForm();
        }
    }

    public function addUpdateBookPhoto()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $imgManager = new ImgManager();
            $bookManager = new BookManager();

            $idBook = Utils::protectGet($_GET['id']);

            $type = 'book';

            $fileExistDb = Utils::checkIfPhotoExistInDb($idBook);

            if($imgManager->lastIdInsert() === 1){
                $newImgId = $imgManager->lastIdInsert();
            } else {
                $newImgId = $imgManager->lastIdInsert() + 1;
            }

            if (!empty($fileExistDb)) {
                $imgManager->deleteImg($fileExistDb->getIdImg());
                unlink(ROOT_FS . '/views/img/' . $type . '/' . $fileExistDb->getName());
            }

            $fileName = $newImgId . '_photoAdmin' . '.' . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            $imgManager->addImg($fileName, $idBook, $type);

            Utils::uploadPicture($type, $fileName);

            $this->displayUpdateBookForm();
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
                    'id' => $data['id_Book'],
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'content' => Utils::limitContentLenght($data['content']),
                    'availability' => $data['status'],
                    'img' => $imgManager->getImgByOwnerId($data['id_Book'])->getName(),
                ];
            }
        }
        return $allBooksOwner;
    }

    public function updateBook()
    {
        $title = htmlspecialchars(Utils::request("title"));
        $author = htmlspecialchars(Utils::request("author"));
        $description = htmlspecialchars(Utils::request("textarea"));
        $availability = Utils::request("availability");
        $id_Book = Utils::protectGet($_GET['id']);

        $bookManager = new BookManager();
        $bookManager->updateBook($id_Book, $title, $author, $description, $availability);

        $this->displayUpdateBookForm();
    }

    public function deleteBook()
    {
        $id_Book = Utils::protectGet($_GET['id']);
        $bookManager = new BookManager();
        $bookManager->deleteBook($id_Book);

        $adminController = new AdminController();
        $adminController->showAdmin();
    }
}
<?php

class BookController
{
    /**
     * Display book page
     */
    public function showBook()
    {
        $bookManager = new BookManager;
        $idBook = (int)Utils::protectGet($_GET['idBook']);
        $bookData = $bookManager->getBookById($idBook);

        $imgManager = new ImgManager();
        $userPhoto = $imgManager->getImgByOwnerId($idBook)->getName();

        $ownerData = $this->getOwnerInfo($bookData->getOwnerId());

        $view = new View("BookPage");
        $view->render("bookPage",[
            'dataBook' => $bookData,
            'dataUser' => $ownerData,
            'userPhoto' => $userPhoto
        ]);
    }


    /**
     * Display all books.
     */
    public function displayAllBooks()
    {
        $dataBooks = $this->getAllBooksInformation();
        $view = new View("AllBooks");
        $view->render("allBooks",[
            'dataBooks' => $dataBooks,
        ]);
    }

    /**
     * Display form for add book.
     */
    public function displayAddBookForm($message=null)
    {
        $view = new View("AddBookForm");
        $view->render("addBookForm",[
            'message' => $message
            ]);
    }

    /**
     * Display form for update book.
     */
    public function displayUpdateBookForm($message=null)
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
            'img' => $img,
            'message' => $message
        ]);
    }

    /**
     * Show book deletion check.
     */
    public function displayDeleteBookVerification(){
        $id_book = Utils::protectGet($_GET['id']);

        $view = new View("deleteBook");
        $view->render("deleteBook",[
            'id_book' => $id_book,
        ]);

    }

    /**
     * Add a book.
     */
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

        $message = 'Votre livre a bien été ajouté.';

        $this->displayAddBookForm($message);
    }

    /**
     * Add a picture book.
     */
    public function addImgBook($owner_Id)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $bookManager = new BookManager();
            $imgManager = new ImgManager();
            $allBookOwner = $bookManager->getBooksByOwner($owner_Id);

            $type = 'book';

            $fileExist = Utils::checkIfPhotoExist($allBookOwner[0]['id_Book']);

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
            $imgManager->addImg($newFileName, $allBookOwner[0]['id_Book'], $type);

            Utils::uploadPicture($type, $newFileName);
        }
    }

    /**
     * Update book photo.
     */
    public function updateBookPhoto()
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

    /**
     * Get book info.
     */
    public function getBookInfo($idOwner=null)
    {
        $userManager = new UserManager();

        if($idOwner === null){
            $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());
        } else {
            $userdata = $userManager->getUserById($idOwner);
        }


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

    /**
     * Update Book
     */
    public function updateBook()
    {
        $title = htmlspecialchars(Utils::request("title"));
        $author = htmlspecialchars(Utils::request("author"));
        $description = htmlspecialchars(Utils::request("textarea"));
        $availability = Utils::request("availability");
        $id_Book = Utils::protectGet($_GET['id']);

        $bookManager = new BookManager();
        $bookManager->updateBook($id_Book, $title, $author, $description, $availability);

        $successMessage = 'Votre livre a bien été mis a jour';

        $this->displayUpdateBookForm($successMessage);
    }

    /**
     * Delete book
     */
    public function deleteBook()
    {
        $id_Book = Utils::protectGet($_GET['id']);

        $type = 'book';

        $fileExist = Utils::checkIfPhotoExist($id_Book);

        if (!empty($fileExist)) {
            $oldFileName = $fileExist->getName();
            unlink(ROOT_FS . '/views/img/' . $type . '/' . $oldFileName);
        }
        
        $bookManager = new BookManager();
        $bookManager->deleteBook($id_Book);

        $imgManager = new ImgManager();
        $imgManager->deleteImgByOwner($id_Book);

        $adminController = new AdminController();
        $adminController->showAdmin();
    }

    /**
     * Get all books information
     */
    public function getAllBooksInformation()
    {
        $bookManager = new BookManager();
        $books = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = htmlspecialchars(Utils::request('search'));
            $booksData = $bookManager->getBookByName($search);
        } else {
            $booksData = $bookManager->getAllBooks();
        }

        $userManger = new UserManager();
        $imgManager = new ImgManager();

        foreach ($booksData as $bookData){
            $books[] = [
                'idBook' => $bookData->getIdBook(),
                'title' => $bookData->getTitle(),
                'author' => $bookData->getAuthor(),
                'owner' => $userManger->getUserById($bookData->getOwnerId())->getPseudo(),
                'imgName' => $imgManager->getImgByOwnerId($bookData->getIdBook())->getName(),
            ];
        }

        return $books;
    }

    public function getOwnerInfo($idOwner)
    {
        $userManager = new UserManager();
        $userInfo = $userManager->getUserById($idOwner);

        $imgManager = new ImgManager();
        $userPhoto = $imgManager->getImgByOwnerId($userInfo->getIdUser());
        
        $userData = [
            'id' => $userInfo->getIdUser(),
            'pseudo' => $userInfo->getPseudo(),
            'photo' => $userPhoto->getName(),
            'dateUser' => $userInfo->getDateUser()->format('d-m-Y'),
        ];

        return $userData;
    }

}
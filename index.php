<?php

require_once 'config/autoload.php';
require_once 'config/_config.php';

$action = Utils::request('action', 'home');

try {
    switch ($action) {
        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;

        case 'connectionForm':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;

        case 'connectUser':
            $adminController = new AdminController();
            $adminController->connectUser();

        case 'disconnectUser':
            $adminController = new AdminController();
            $adminController->disconnectUser();

        case 'createUserForm':
            $adminController = new AdminController();
            $adminController->displayCreateUserForm();
            break;

        case 'createUser':
            $adminController = new AdminController();
            $adminController->createUser();
            break;

        case 'admin' :
            $adminController = new AdminController();
            $adminController->showAdmin();
            break;

        case 'updatePhotoForm':
            $adminController = new AdminController();
            $adminController->displayUpdatePhotoForm();
            break;

        case 'uploadProfilPicture':
            $adminController = new AdminController();
            $adminController->addUpdateProfilePhoto();
            break;

        case 'updateInfoUser':
            $adminController = new AdminController();
            $adminController->updateInfoUser();
            break;

        case 'addBookForm':
            $bookController = new BookController();
            $bookController->displayAddBookForm();
            break;

        case 'updateBookForm':
            $bookController = new BookController();
            $bookController->displayUpdateBookForm();
            break;

        case 'uploadBookPicture':
            $adminController = new BookController();
            $adminController->updateBookPhoto();
            break;

        case 'addBook':
            $bookController = new BookController();
            $bookController->addBook();
            break;

        case 'updateBook':
            $bookController = new BookController();
            $bookController->updateBook();
        break;

        case 'deleteBookVerification':
            $bookController = new BookController();
            $bookController->displayDeleteBookVerification();
        break;

        case 'deleteBook':
            $bookController = new BookController();
            $bookController->deleteBook();
            break;

        case 'displayBook':
            $bookController = new BookController();
            $bookController->showBook();
            break;

        case 'displayAllBooks':
            $bookController = new BookController();
            $bookController->displayAllBooks();
            break;

    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
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
        case 'admin' :
            $adminController = new AdminController();
            $adminController->showAdmin();
            break;
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
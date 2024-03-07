<?php

class AdminController
{
    /**
     * Display admin page
     */
    public function showAdmin() : void
    {
        $this->checkIfUserIsConnected();

        $view = new View("Administration");
        $view->render("admin");
    }

    /**
     * Display connection form
     */
    public function displayConnectionForm()
    {

        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Display create user form
     */
    public function displayCreateUserForm()
    {
        $view = new View("NouvelUtilisateur");
        $view->render("createUserForm");
    }

    /**
     * Connection de l'utilisateur.
     * @return void
     */
    public function connectUser()
    {
        // On récupère les données du formulaire.
        $login = Utils::request("login");
        $password = Utils::request("password");

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($login);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash('toto', PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        Utils::redirect("admin");
    }

    /**
     * User disconnection.
     * @return void
     */
    public function disconnectUser() : void
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    /**
     * Verifies that the user is logged in.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }
}
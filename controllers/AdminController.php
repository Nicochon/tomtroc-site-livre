<?php

class AdminController
{
    /**
     * Display admin page
     */
    public function showAdmin() : void
    {
        $this->checkIfUserIsConnected();
        $bookController = new BookController();

        $booksInfo = $bookController->getBookInfo();
        $userData = $this->getUserData();

        if(!empty($userData)){
            $view = new View("Administration");
            $view->render("admin", [
                'userInfo' => $userData,
                'booksInfo' => $booksInfo,
            ]);
        }
    }

    public function showPublicProfile()
    {
        $idUser = (int)Utils::protectGet($_GET['id']);
        $userData = $this->getUserData($idUser);

        $bookController = new BookController();
        $booksInfo = $bookController->getBookInfo($idUser);

        $idSession = '';
        if(isset($_SESSION['user'])){
            $idSession = $_SESSION['user']->getId();
        }

        $view = new View("PublicProfile");
        $view->render("publicProfile", [
            'userInfo' => $userData,
            'booksInfo' => $booksInfo,
            'idSession' => $idSession
        ]);
    }

    /**
     * Display connection form
     */
    // a changer le nom
    public function displayConnectionForm()
    {
        $view = new View("Connexion");

        if($this->displayErrorMessage()){
            $view->render("connectionForm", [
                'error' => 'Les identifiants utilisés sont incorrects'
            ]);
        } else {
            $view->render("connectionForm", [
                'error' => ''
            ]);
        }
    }

    /**
     * Display create user form
     */
    public function displayCreateUserForm()
    {
        $view = new View("NouvelUtilisateur");

        if($this->displayErrorMessage()) {
            if (isset($_GET['errorPseudo']) || isset($_GET['errorEmail'])) {
                $view->render("createUserForm", [
                    'errorPseudo' => $_GET['errorPseudo'],
                    'errorEmail' => $_GET['errorEmail'],
                ]);
            }
        } else {
            $view->render("createUserForm", [
                'errorPseudo' => '',
                'errorEmail' => '',
            ]);
        }
    }

    /**
     * Display create user form
     */
    public function displayUpdatePhotoForm()
    {
        $this->checkIfUserIsConnected();

        $idBook = '';
        
        if($_GET['key'] === 'book'){
            $BookManager = new BookManager();
            $bookData = $BookManager->getBookById($_GET['id']);
            $idBook = $bookData->getIdBook();
        }

        $view = new View("NouvelPhoto");
        $view->render("newPhotoForm", [
            'type' => $_GET['key'],
            'idBook' => $idBook,
        ]);
    }

    /**
     * Connection de l'utilisateur.
     * @return void
     */
    public function connectUser()
    {
        // On récupère les données du formulaire.
        $email = htmlspecialchars(Utils::request("pseudo"));
        $password = htmlspecialchars(Utils::request("password"));
        
        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        $errorMessage = false;
        // On vérifie si le pseudo est correct
        if (!$user){
//            throw new Exception("Les identifiants utilisées sont incorects");
            $errorMessage = true;
        }

        // On vérifie si le mot de passe est correct
        if(!$errorMessage){
            if (!password_verify($password, $user->getPassword())) {
//            throw new Exception("Les identifiants utilisées sont incorects");
                $errorMessage = true;
            }
        }

        if ($errorMessage){
            $error = [
              'errorMessage' => 'error',
            ];
            Utils::redirect("connectionForm", $error );

        } else {
            $_SESSION['user'] = $user;
            $_SESSION['idUser'] = $user->getId();

            Utils::redirect("admin");
        }
    }

    /**
     * Create a new user.
     * @return void
     */
    public function createUser()
    {
        // On récupère les données du formulaire.
        $pseudo = htmlspecialchars(Utils::request("pseudo"));
        $password = htmlspecialchars(Utils::request("password"));
        $email = htmlspecialchars(Utils::request("email"));

        $pseudoExist = $this->checkIfPseudoExist($pseudo);
        $emailExist = $this->checkIfEmailExist($email);

        $errorMessage = false;

        if($pseudoExist){
            $errorMessage = true;
        }
        if ($emailExist){
            $errorMessage = true;
        }

        if ($errorMessage){
            $error = [
                'errorMessage' => 'error',
                'errorPseudo' => $pseudoExist,
                'errorEmail' => $emailExist,
            ];
            Utils::redirect("createUserForm", $error );
        } else {
            $user = new User([
                'pseudo' => $pseudo,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
            ]);
            $userManager = new UserManager();
            $userManager->addUser($user);

            $this->displayConnectionForm();
        }
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
    public function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Verifies that the pseudo Exist.
     * @return void
     */
    private function checkIfPseudoExist ($pseudo)
    {
        $userManager = new UserManager();
        $userPseudo = $userManager->getUserByPseudo($pseudo);

        if ($userPseudo){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifies that the email Exist.
     * @return void
     */
    private function checkIfEmailExist ($email)
    {
        $userManager = new UserManager();
        $userEmail = $userManager->getUserByEmail($email);

        if ($userEmail){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create Array with user info
     * @return array
     */
    public function getUserData($idUser=null)
    {
        $userManager = new UserManager();

        if($idUser === null){
            $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());
        } else {
            $userdata = $userManager->getUserById($idUser);
        }

        $imgManager = new ImgManager();

        $img = $imgManager->getImgByOwnerId($userdata->getIdUser());

        if($img === null){
            $imgName = false;
        } else {
            $imgName = $img->getName();
        }

        $user[] = [
            'pseudo' => $userdata->getPseudo(),
            'email' => $userdata->getEmail(),
            'password' => $userdata->getPassword(),
            'dateUser' => $userdata->getDateUser()->format('d-m-Y'),
            'idUser' => $userdata->getIdUser(),
            'imgName' => $imgName,
        ];

        return $user[0];
    }

    public function addUpdateProfilePhoto()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $imgManager = new ImgManager();
            $userManager = new UserManager();
            $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

            $idUser = $userdata->getIdUser();
            $type = 'admin';

            $fileExistDb = Utils::checkIfPhotoExistInDb($idUser);

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
            $imgManager->addImg($fileName, $idUser, $type);

            Utils::uploadPicture($type, $fileName);

            $this->showAdmin();
        }
    }

    /**
     * Update info user
     * @return void
     */
    public function updateInfoUser()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        if(Utils::request("password") != "************"){
            $password = password_hash(Utils::request("password"), PASSWORD_DEFAULT);
        } else {
            $password = $userdata->getPassword();
        }

        $user = new User([
            'id' => $userdata->getIdUser(),
            'pseudo' => $pseudo,
            'email' => $email,
            'passWord' => $password
        ]);

        $userManager->updateInfoUser($user);

        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        $this->showAdmin();
    }

    public function displayErrorMessage()
    {
        if( isset($_GET['errorMessage']) && Utils::protectGet($_GET['errorMessage']) === 'error'){
            return true;
        } else {
            return false;
        }
    }
}
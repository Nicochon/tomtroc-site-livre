<?php

class AdminController
{
    /**
     * Display admin page
     */
    public function showAdmin() : void
    {
        $this->checkIfUserIsConnected();
        $userData = $this->getUserData();
        if(!empty($userData)){
            $view = new View("Administration");
            $view->render("admin", [
                'userInfo' => $userData,
            ]);
        }
    }

    /**
     * Display connection form
     */
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
        $view = new View("NouvelPhoto");
        $view->render("newPhotoForm");
    }

    /**
     * Connection de l'utilisateur.
     * @return void
     */
    public function connectUser()
    {
        // On récupère les données du formulaire.
        $pseudo = htmlspecialchars(Utils::request("pseudo"));
        $password = htmlspecialchars(Utils::request("password"));
        
        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByPseudo($pseudo);
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
    private function checkIfUserIsConnected() : void
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
    public function getUserData()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $user[] = [
            'pseudo' => $userdata->getPseudo(),
            'email' => $userdata->getEmail(),
            'password' => $userdata->getPassword(),
            'dateUser' => $userdata->getDateUser()->format('d-m-Y'),
            'idUser' => $userdata->getIdUser(),
            'imgName' => $userdata->getImgName(),
        ];

        return $user[0];
    }

    /**
     * Save photo
     * @return array
     */
    public function uploadProfilPicture()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $oldFileName =  $userdata->getImgName();

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $newFileName = $this->updateProfilePicture();

            $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            if ($extension === 'png' || $extension === 'jpeg' || $extension === 'jpg'){
                $destination = ROOT_FS . '/views/img/admin/' . $newFileName;
                if($oldFileName != ""){
                    unlink(ROOT_FS . '/views/img/admin/' .$oldFileName);
                }
                move_uploaded_file($_FILES["photo"]["tmp_name"], $destination);
            } else {
                echo 'Choose only png ';
            }
            $this->showAdmin();
        }

    }

    /**
     * update profile photo in database
     * @return string
     */
    public function updateProfilePicture()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $profilePictureName = $this->renamePicture();

        $user = new User([
            'idUser' => $userdata->getIdUser(),
            'imgName' => $profilePictureName
        ]);

        $userManager->updateProfilePicture($user);

        return $profilePictureName;
    }

    /**
     * Rename Picture
     * @return string
     */
    public function renamePicture()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $newFileName = 'photo_profil_idUser_' . $userdata->getIdUser() . '.' . $extension;

        return $newFileName;
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
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
        $pseudo = Utils::request("pseudo");
        $password = Utils::request("password");

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByPseudo($pseudo);

        // On vérifie si le pseudo est correct
        if (!$user){
            throw new Exception("Les identifiants utilisées sont incorects");
        }
        // On vérifie si le mot de passe est correct
        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Les identifiants utilisées sont incorects");
        }

        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        Utils::redirect("admin");
    }

    /**
     * Create a new user.
     * @return void
     */
    public function createUser()
    {
        // On récupère les données du formulaire.
        $pseudo = Utils::request("pseudo");
        $password = Utils::request("password");
        $email = Utils::request("email");

        //vérifier si le pseudo n'existe pas
        $exist = $this->checkIfUserExist($pseudo, $email);
        $error_message = "Le pseudo utilisateur $pseudo existe déjà.";
        // On crée l'objet User.
        if($exist === 'pseudo'){
            echo "<script type='text/javascript'>alert('Le pseudo utilisateur $pseudo existe déjà.');</script>";
            $this->displayCreateUserForm();
//            throw new Exception("Le pseudo utilisateur $pseudo existe déja");
        } elseif ($exist === 'email'){
            echo "<script type='text/javascript'>alert('L\'email utilisateur $email existe déja.');</script>";
            $this->displayCreateUserForm();
//            throw new Exception("L'email utilisateur $email existe déja");
        } else {
            $user = new User([
                'pseudo' => $pseudo,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
            ]);
        }

        // add user.
        $userManager = new UserManager();
        $userManager->addUser($user);

        $this->displayConnectionForm();
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

    private function checkIfUserExist($pseudo, $email)
    {
        $userManager = new UserManager();
        $userPseudo = $userManager->getUserByPseudo($pseudo);
        $userEmail = $userManager->getUserByEmail($email);

       if ($userPseudo){
           return 'pseudo';
       } elseif ($userEmail) {
           return 'email';
       } else {
           return true;
       }
    }

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

    public function renamePicture()
    {
        $userManager = new UserManager();
        $userdata = $userManager->getUserByPseudo($_SESSION['user']->getPseudo());

        $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $newFileName = 'photo_profil_idUser_' . $userdata->getIdUser() . '.' . $extension;

        return $newFileName;
    }

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
}
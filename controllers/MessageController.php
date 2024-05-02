<?php

class MessageController
{
    public function displayMessage()
    {
        $adminController = new AdminController();
        $adminController->checkIfUserIsConnected();

        $idUser = Utils::protectGet($_GET['idUser']);

        $conversationManager = new ConversationManager();
        $conversations = $conversationManager->getConversationByUserAdmin($idUser);

        $data = [];

        $messageManager = new MessageManager();
        $userManager = new UserManager();
        $imgManager = new ImgManager();

        foreach ($conversations as $conversation) {
            if ($conversation['id_sender'] != $idUser) {
                $id_contact = $conversation['id_sender'];
            } else {
                $id_contact = $conversation['id_recipient'];
            }

            $data[] =[
                'name' => $userManager->getUserById($id_contact)->getPseudo(),
                'id_user' => $id_contact,
                'id_conversation' => $conversation['id_conversation'],
                'conversations' => $messageManager->getMessageByIdConversation($conversation['id_conversation']),
                'img' => $imgManager->getImgByOwnerId($id_contact)->getName()
            ];
        }

        $view = new View('Chat');
        $view->render('chat',[
            'conversations' => $data
        ]);
    }

    public function displayConversation(){

        $idConversation = Utils::protectGet($_GET['idConversation']);
        $idContact = Utils::protectGet($_GET['idContact']);

        $imgManager = new ImgManager();
        $messageManager = new MessageManager();
        $userManager = new UserManager();

        $data = [
            'conversation' => $messageManager->getMessageByIdConversation($idConversation),
            'img' => $imgManager->getImgByOwnerId($idContact)->getName(),
            'pseudo' => $userManager->getUserById($idContact)->getPseudo(),
        ];

        $view = new View('Conversation');
        $view->render('conversation',[
            'conversation' => $data
        ]);
    }

    public function sendMessage()
    {

    }

    public function getConversationByUser($idUser)
    {
        $conversationManager = new ConversationManager();
        $conversations = $conversationManager->getConversationByUserAdmin($idUser);
        return $conversations;
    }

    public function getAllAdminConversation(){

    }

    public function postMessage()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $contentMessage = htmlspecialchars(Utils::request('message'));

            $conversation = Utils::checkIfConversationExist(Utils::protectGet($_GET['idUser']), Utils::protectGet($_GET['idRecipient']));

            if($conversation){
                echo '<pre>';
                var_dump('post message avec l\'id_conversation '. $conversation);
                echo '</pre>';
            } else {
                echo '<pre>';
                var_dump('create conversation');
                var_dump('post message');
                echo '</pre>';
            }

        }
    }


}
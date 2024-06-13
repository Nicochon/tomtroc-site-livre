<?php

class MessageController
{
    public function displayMessage()
    {
        $adminController = new AdminController();
        $adminController->checkIfUserIsConnected();

        $idNewContact = 0;
        $newContact = [];
        $dataNewContact = [];

        $idUser = Utils::protectGet($_GET['idUser']);
        if(isset($_GET['idNewContact'])){
            $idNewContact = Utils::protectGet($_GET['idNewContact']);
            $newContact = Utils::checkIfConversationExist($idUser, $idNewContact);
        }
        
        $conversationManager = new ConversationManager();
        $conversations = $conversationManager->getConversationByUserAdmin($idUser);

        $data = $this->getDataConversations($idUser, $conversations);
        $getDate = $this->dateConversion($data, 'dateHeure');

        $userManager = new UserManager();
        $imgManager = new ImgManager();

        if(!$newContact && $idNewContact != 0){
            $dataNewContact = [
                'name' => $userManager->getUserById($idNewContact)->getPseudo(),
                'id_newContact' => $idNewContact,
                'img' => $imgManager->getImgByOwnerId($idNewContact)->getName()
            ];
        }

        $view = new View('Chat');
        $view->render('chat',[
            'conversations' => $getDate,
            'newConversations' => $dataNewContact
        ]);
    }

    public function displayConversation(){

        $idConversation = Utils::protectGet($_GET['idConversation']);
        $idContact = Utils::protectGet($_GET['idContact']);

        $data = $this->getDataConversation($idConversation, $idContact);

        $view = new View('Conversation');
        $view->render('conversation',[
            'conversation' => $data
        ]);
    }


    public function postMessage()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $contentMessage = htmlspecialchars(Utils::request('message'));

            $idUser = Utils::protectGet($_GET['idUser']);
            $idContact = Utils::protectGet($_GET['idRecipient']);

            $conversation = Utils::checkIfConversationExist($idUser, $idContact);

            $conversationManager= new ConversationManager();
            $messageManager = new MessageManager();

            if($conversation){
                $messageManager->addMessage($contentMessage, $idUser, $idContact, $conversation );
                $conversationManager->updateDate($conversation);
            } else {
                $conversationManager->addConversation($idUser,$idContact);
                $newConversation = Utils::checkIfConversationExist($idUser, $idContact);
                $messageManager->addMessage($contentMessage, $idUser, $idContact, $newConversation );
            }

        }

        $this->displayMessage();
    }

    public function getDataConversations($idUser, $conversations)
    {
        $messageManager = new MessageManager();
        $userManager = new UserManager();
        $imgManager = new ImgManager();

        $data = [];

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

        return $data;
    }

    public function getDataConversation($idConversation, $idContact)
    {
        $imgManager = new ImgManager();
        $messageManager = new MessageManager();
        $userManager = new UserManager();

        $data = [
            'conversation' => $messageManager->getMessageByIdConversation($idConversation),
            'img' => $imgManager->getImgByOwnerId($idContact)->getName(),
            'pseudo' => $userManager->getUserById($idContact)->getPseudo(),
            'id_recipient' => $userManager->getUserById($idContact)->getIdUser(),
        ];

        return $data;
    }

    public function dateConversion($datas, $type)
    {
        $currentDateTime = new DateTime();
        $dateA = new DateTime($currentDateTime->format('Y-m-d H:i:s'));
        foreach ($datas as $data){
            foreach ($data['conversations'] as $conversation){
                $dateB = new DateTime($conversation->getDate());
                $interval = $dateA->diff($dateB);
                $totalHours = ($interval->days * 24) + $interval->h + ($interval->i / 60) + ($interval->s / 3600);

                if ($totalHours >= 24){
                    $formattedDate = $dateB->format('m-d');
                } else {
                    $formattedDate = $dateB->format('H:i');
                }
                $conversation->setDate($formattedDate);
            }
        }

        return $datas;
    }


}
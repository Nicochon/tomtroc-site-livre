<?php

class MessageController
{
    public function displayMessage()
    {
        $adminController = new AdminController();
        $adminController->checkIfUserIsConnected();


        $view = new View("Chat");
        $view->render("chat");
    }
}
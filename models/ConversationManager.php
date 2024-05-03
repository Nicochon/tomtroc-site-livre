<?php

/**
 * Classe ConversationManager pour gérer les requêtes liées aux conversations.
 */

class ConversationManager extends AbstractEntityManager
{
    public function getConversationByUsers($userOne, $userTwo)
    {
        $sql = "SELECT * FROM conversations WHERE 
                (id_sender = :userOne AND id_recipient = :userTwo) OR
                (id_recipient = :userOne AND id_sender = :userTwo)";

        $result = $this->db->query($sql, [
            'userOne' => $userOne,
            'userTwo' => $userTwo,
            ]);

        $conversation = $result->fetch();

        return $conversation;
    }

    public function getConversationByUserAdmin($id_admin)
    {
        $sql = "SELECT * FROM conversations WHERE 
                (id_sender = :id_admin) OR
                (id_recipient = :id_admin) ORDER BY date DESC";
        $result = $this->db->query($sql, [
            'id_admin' => $id_admin,
        ]);

        $conversations = $result->fetchAll();
        return $conversations;
    }

    public function addConversation($id_sender, $id_recipient)
    {
        $sql = "INSERT INTO conversations (id_sender, id_recipient, date) VALUES (:id_sender, :id_recipient, NOW())";
        $this->db->query($sql, [
            'id_sender' => $id_sender,
            'id_recipient' => $id_recipient
        ]);
    }

    public function updateDate($id_conversation)
    {
        $sql = "UPDATE conversations SET date = NOW() WHERE id_conversation =:id_conversation";
        $this->db->query($sql, [
            'id_conversation' => $id_conversation,
        ]);
    }
}

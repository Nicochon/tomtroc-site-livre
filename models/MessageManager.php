<?php

/**
 * Classe MessageManager pour gérer les requêtes liées aux messages.
 */

class MessageManager extends AbstractEntityManager
{
        public function getMessageByOwner (int $id_owner)
        {
            $sql = "SELECT * FROM message WHERE id_owner = :id_owner order by date desc ";
            $result = $this->db->query($sql, ['id_owner' => $id_owner]);

            $messages = $result->fetchAll();

            if (!empty($messages)) {
                return $messages;
            }

            return null;
        }

    public function getMessageByRecipient (int $id_recipient)
    {
        $sql = "SELECT * FROM message WHERE id_recipient = :id_recipient order by date desc ";
        $result = $this->db->query($sql, ['id_recipient' => $id_recipient]);

        $messages = $result->fetchAll();

        if (!empty($messages)) {
            return $messages;
        }

        return null;
    }

    public function getMessageByIdConversation(int $id_conversation)
    {
        $sql = "SELECT * FROM message WHERE id_conversation = :id_conversation order by date desc  ";

        $result = $this->db->query($sql,
            ['id_conversation' => $id_conversation]
        );

        $messages = [];
        
        foreach ($result->fetchAll() as $dataMessage){
            $messages [] = new Message($dataMessage);
        }

        return $messages;
    }

    public function addMessage($content, $id_owner, $id_recipient, $id_conversation)
    {
        $sql = "INSERT INTO message (content, id_owner, id_recipient, date, id_conversation) VALUES (:content, :id_owner, :id_recipient, NOW(), :id_conversation)";
        $this->db->query($sql, [
            'content' => $content,
            'id_owner' => $id_owner,
            'id_recipient' => $id_recipient,
            'id_conversation' => $id_conversation,
        ]);
    }

}
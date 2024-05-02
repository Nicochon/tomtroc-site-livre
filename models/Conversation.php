<?php

/**
 * Entité User : un user est défini par son id, un login, un password, un email, une photo.
 */
class conversation extends AbstractEntity
{
    private int $id_conversation;
    private int $id_sender;
    private int $id_recipient;

    private ?DateTime $date = null;

    public function getIdConversation(): int
    {
        return $this->id_conversation;
    }

    public function setIdConversation(int $id_conversation): void
    {
        $this->id_conversation = $id_conversation;
    }

    public function getIdSender(): int
    {
        return $this->id_sender;
    }

    public function setIdSender(int $id_sender): void
    {
        $this->id_sender = $id_sender;
    }

    public function getIdRecipient(): int
    {
        return $this->id_recipient;
    }

    public function setIdRecipient(int $id_recipient): void
    {
        $this->id_recipient = $id_recipient;
    }

}
<?php

namespace App\Repository;

interface ChatRepository
{
    public function getUserChatList($userId);

    public function setNewChat($userId, $receiverId , $type , $subject);

    public function getUserChatInfo($threadId , $userId);

    public function getChatMessages($threadId, $pages);

    public function sendNewMessage($userId, $threadId, $messageBody);
}

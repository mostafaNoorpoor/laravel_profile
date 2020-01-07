<?php

namespace App\Http\Controllers;

use App\Repository\ChatRepository;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $chat;

    public function __construct(ChatRepository $chat)
    {
        $this->chat = $chat;
    }

    public function getChatList(Request $request)
    {
        $chatList = $this->chat->getUserChatList($request->userId);

        return response()->json(['data' => $chatList]);

    }

    public function newChatUser(Request $request)
    {
        $newChatStatus = $this->chat->setNewChat($request->userId , $request->receiverId , $request->type , $request->subject);

        return response()->json(['data' => $newChatStatus]);
    }

    public function userChatInfo($threadId , Request $request)
    {
        $userChatInfo = $this->chat->getUserChatInfo($threadId , $request->userId);

        return response()->json(['data' => $userChatInfo]) ;

    }

    public function getChatMessages($threadId , $pages)
    {
        $messages = $this->chat->getChatMessages($threadId , $pages);

        return response()->json(['data' => $messages]);
    }

    public function sendMessage($threadId , Request $request)
    {
        $sendStatus = $this->chat->sendNewMessage($request->userId , $threadId , $request->messageBody);

        return response()->json(['data' => $sendStatus]);
    }

}

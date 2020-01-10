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
        $chatList = $this->chat->getUserChatList($request->user());

        return response()->json(['data' => $chatList]);

    }

    public function newChatUser(Request $request)
    {
//        $request->validate([
//            'receiver_id ' => 'required',
//            'type ' => 'required',
//        ]);

        $newChatStatus = $this->chat->createNewChat($request->user() , $request->receiver_id , $request->type , $request->subject);

        return response()->json(['data' => $newChatStatus]);
    }

    public function userChatInfo($threadId , Request $request)
    {
//        $request->validate([
//            'receiver_id ' => 'required',
//        ]);

        $userChatInfo = $this->chat->getUserChatInfo($threadId , $request->receiver_id);

        return response()->json(['data' => $userChatInfo]) ;

    }

    public function getChatMessages($threadId , $pages)
    {
        $messages = $this->chat->getChatMessages($threadId , $pages);

        return response()->json(['data' => $messages]);
    }

    public function sendMessage($threadId , Request $request)
    {
//        $request->validate([
//            'message_body ' => 'required',
//        ]);

        $sendStatus = $this->chat->sendNewMessage($request->user() , $threadId , $request->message_body);

        return response()->json(['data' => $sendStatus]);
    }

}

<?php

namespace App\Repository;

use App\User;
use Carbon\Carbon;

use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;


class ChatImplement implements ChatRepository
{
    public function getUserChatList($userId)
    {
        if (User::where('id', $userId)->exists()) {

            $message = Thread::forUser($userId)->latest('updated_at')->get();

        } else {

            $message = "user not exist in user table";

        }

        return $message;

    }

    public function setNewChat($userId, $receiverId , $type , $subject)
    {
        if ($user = User::where('id', $receiverId)->first()){

            switch ($type){

                case  'UserToUser' :

                    $thread = Thread::create([
                        'subject' => $user->name,
                    ]);

                    Participant::create([
                        'thread_id' => $thread->id,
                        'user_id' => $userId,
                        'last_read' => new Carbon,
                    ]);

                    Participant::create([
                        'thread_id' => $thread->id,
                        'user_id' => $receiverId,
                        'last_read' => new Carbon,
                    ]);

                    break;

                case 'UserToGroup' :

                    $thread = Thread::create([
                        'subject' => $subject,
                    ]);

                    // we should insert group Participant user Ids here *_*

                    break ;
            }

            $message = "set successFully";

        } else {

            $message = "user not exist in user table";
        }

        return $message;

    }

    public function getUserChatInfo($threadId , $userId)
    {
        // $userId --> همون آیدی شخصی که میخواد باهاش چت کنه

        if ($thread = Thread::where('id', $threadId)->first()){

            $message = array();

            $message['participants'] = Participant::where([
                ['user_id', '=', $userId],
                ['thread_id', '=', $threadId]
            ])->first();

            $message['userInfo'] = User::where('id' , $message['participants']->user_id)->first();

        } else {
            $message = "thread does not exist";
        }
        return $message ;
    }

    public function getChatMessages($threadId, $pages)
    {
        $messageQuery = Message::where('thread_id' , $threadId) ;

        if ($messages = $messageQuery->first() ) {

            $message = $messageQuery->paginate($pages);

        } else {

            $message = "messages does not exist with this thread id";

        }

        return $message ;

    }

    public function sendNewMessage($userId, $threadId, $messageBody)
    {
        $message = Message::create([
            'thread_id' => $threadId,
            'user_id' => $userId,
            'body' => $messageBody,
        ]);

        return $message ;

    }
}

<?php

namespace App\Repository;

use App\User;
use Carbon\Carbon;

use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Pagination\Paginator;


class ChatImplement implements ChatRepository
{

    public function getUserChatList($token)
    {
        // in handler exceptions --> handling not found token exception

        $message = Thread::forUser($token->id)->latest('updated_at')->get();

        return $message;

    }

    public function createNewChat($token, $receiverId , $type , $subject)
    {

        if ($user = User::where('id', $receiverId)->first()){

            switch ($type){

                case  'UserToUser' :

                    $thread = Thread::create([
                        'subject' => $user->name,
                    ]);

                    Participant::create([
                        'thread_id' => $thread->id,
                        'user_id' => $token->id,
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

            abort(404 , "receiver user id not found");

        }

        return $message;

    }

    public function getUserChatInfo($threadId , $receiverId)
    {

        if ($user = User::where('id', $receiverId)->first()){

            if ($thread = Thread::where('id', $threadId)->first()){

                $message = array();

                // note : its just for user to user ---->

                $message['participants'] = Participant::where([
                    ['user_id', '=', $receiverId],
                    ['thread_id', '=', $threadId]
                ])->first();

                $message['userInfo'] = User::where('id' , $message['participants']->user_id)->first();

                // note : its just for user to user <----

            } else {

                abort(404 , "thread does not exist");

            }

        } else {

            abort(404 , "receiver user id not found");

        }
        return $message ;
    }

    public function getChatMessages($threadId, $pages)
    {

        $messageQuery = Message::where('thread_id' , $threadId)->orderBy('id', 'DESC') ;

        if ($messages = $messageQuery->first() ) {

            Paginator::currentPageResolver(function() use ($pages) {
                return $pages;
            });

            $message = $messageQuery->paginate(15);

        } else {

            abort(404 , "messages does not exist with this thread id");

        }

        return $message ;

    }

    public function sendNewMessage($token, $threadId, $messageBody)
    {

        $message = Message::create([
            'thread_id' => $threadId,
            'user_id' => $token->id,
            'body' => $messageBody,
        ]);

        return $message ;
    }
}

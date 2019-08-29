<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\EventComment;

class EventCommentTransformers extends TransformerAbstract
{
    /**
     * Transform Event.
     *
     * @param EventComment $cventcomment
     */
    public function transform(EventComment $comment)
    {
        return [
            'id'            => $comment->id,
            'username'      => $comment->username,
            'userpict'      => $comment->userpict,
            'comment'       => $comment->comment,
            'id_event'      => $comment->id_event,
            'id_user'       => $comment->id_user,

        ];
    }
}
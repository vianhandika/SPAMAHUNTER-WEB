<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Message;

class MessageTransformers extends TransformerAbstract
{
    /**
     * Transform Message.
     *
     * @param Message $message
     */
    public function transform(Message $message)
    {
        return [
            'id'            => $message->id,
            'name'          => $message->name,
            'subject'       => $message->subject,
            'email'         => $message->email,
            'message'       => $message->message,
        ];
    }
}
<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Event;

class EventTransformers extends TransformerAbstract
{
    /**
     * Transform Event.
     *
     * @param Event $event
     */
    public function transform(Event $event)
    {
        return [
            'id'            => $event->id,
            'title'         => $event->title,
            'type'          => $event->type,
            'place'         => $event->place,
            'image'         => $event->image,
            'description'   => $event->description,

            'date_start'    => $event->date_start,
            'date_end'      => $event->date_end,                
            'time_start'    => $event->time_start,
            'time_end'      => $event->time_end,

            'highlight'     => $event->highlight,
            'verify'        => $event->verify,
            'id_user'       => $event->id_user,
        ];
    }
}
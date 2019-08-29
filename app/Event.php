<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'type', 'place','image','description',
        'date_start','date_end','time_start','time_end',
        'highlight','verify','id_user',
    ];
}

<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;

class UserProfile extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'phone','jobstatus','jobplace','publicinfo','id_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

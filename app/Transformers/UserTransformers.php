<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformers extends TransformerAbstract
{
    /**
     * Transform User.
     *
     * @param User $user
     */
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'username'  => $user->username,
            'email'     => $user->email,
            'role'      => $user->role,
            'status'    => $user->status,
            'picture'   => $user->picture,
        ];
    }
}
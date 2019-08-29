<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\UserProfile;

class UserProfileTransformers extends TransformerAbstract
{
    /**
     * Transform Event.
     *
     * @param UserProfile $event
     */
    public function transform(UserProfile $profile)
    {
        return [
            'id'            => $profile->id,
            'firstname'     => $profile->firstname,
            'lastname'      => $profile->lastname,
            'phone'         => $profile->phone,
            'jobstatus'     => $profile->jobstatus,
            'jobplace'      => $profile->jobplace,
            'publicinfo'    => $profile->publicinfo,
            'id_user'       => $profile->id_user,
        ];
    }
}
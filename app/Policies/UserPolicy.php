<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function doctor(User $user,User $member)
    {
        return $member->category->category === 'doctor';
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    public function update(User $user, User $model): bool
    {
        return Auth::user()->id === $model->id;
    }
}

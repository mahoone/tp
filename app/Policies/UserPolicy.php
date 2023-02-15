<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function showStore(User $user)
    {
        return $user->admin;
    }

    public function store(User $user)
    {
        return $user->admin;
    }

    public function setAdmin(User $user, User $model)
    {
        return $user->admin;
    }

    public function update(User $user, User $model)
    {
        return $user->admin || (auth()->check() && $model->id == auth()->id());
    }

    public function delete(User $user, User $model)
    {
        return ($user->admin && auth()->check() && $model->id != auth()->id());
    }

    public function show(User $user, User $model)
    {
        return $user->admin || (auth()->check() && $model->id == auth()->id());
    }
}

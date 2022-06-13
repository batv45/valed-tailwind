<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return $user->can('user.show');
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('user.show');
    }

    public function create(User $user): bool
    {
        return $user->can('user.create');
    }

    public function update(User $user, User $model): bool
    {
        return $user->can('user.update');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can('user.delete');
    }

    public function restore(User $user, User $model): bool
    {
        return $user->can('user.delete');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->can('user.delete');
    }
}

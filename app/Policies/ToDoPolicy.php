<?php

namespace App\Policies;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ToDoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ToDo $toDo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ToDo $todo): Response
    {
        return $user->id === $todo->user_id
        ? Response::allow()
        : Response::deny('You cannot update this to-do item');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ToDo $todo): Response
    {
        // @todo: Admin can delete any to-do item
        return $user->id === $todo->user_id
        ? Response::allow()
        : Response::deny('You cannot delete this to-do item');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ToDo $todo): Response
    {
        //@todo: Admin can restore any to-do item
        return $user->id === $todo->user_id
        ? Response::allow()
        : Response::deny('You cannot restore this to-do item');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ToDo $todo): Response
    {
        // @todo: Admin can force-delete any to-do item
        return $user->id === $todo->user_id
        ? Response::allow()
        : Response::deny('You cannot force-delete this to-do item');
    }
}
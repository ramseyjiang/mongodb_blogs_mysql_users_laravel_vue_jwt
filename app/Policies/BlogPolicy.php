<?php

namespace Figtest\Policies;

use Figtest\Models\User;
use Figtest\Models\Blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if a user can operate a blog.
     * Return $user->id === $blog->user_id;  //Equal to "return $user->is($blog->user);
     * Check ($user->id == 1), it is similar with check admin. If the admin does this operation, it always returns true.
     * If I have enough time, I will add an role_permissions plugins to controll different roles.
     *
     * @param \Figtest\Models\User $user
     * @param \Figtest\Models\Blog $blog
     * @return bool
     */
    public function match(User $user, Blog $blog)
    {
        return ($user->id == 1 || $user->id == $blog->user_id) ? true : false;
    }
}

<?php

namespace App\Policies;

use App\Models\Gig;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GigPolicy
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

    public function edit(User $user, Gig $gig)
    {
        return $user->id === $gig->user_id;
    }

    public function comment(User $user, Gig $gig)
    {
        $transaction = Transaction::where('gig_id', $gig->id)->where('user_id', $user->id)->get();
        if ($transaction->count() > 0 && $gig->user_id != $user->id) {
            return true;
        } else {
            return false;
        }
    }

    public function purchase(User $user, Gig $gig)
    {
        return $user->id !== $gig->user_id;
    }
}

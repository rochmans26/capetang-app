<?php

namespace App\Listeners;

use App\Events\PasswordChanged;
use App\Notifications\PasswordChangedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordChangedNotification
{
    /**
     * Handle the event.
     */
    public function handle(PasswordChanged $event)
    {
        // Send the password change notification
        $event->user->notify(new PasswordChangedNotification($event->user));
    }
}

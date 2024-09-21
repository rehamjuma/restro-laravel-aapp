<?php

namespace App\Listeners;

use App\Events\SendAlertEmailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAlertEmailListener
{
    /**
     * Handle the event.
     */
    public function handle(SendAlertEmailEvent $event): void
    {
        $ingredient = $event->ingredient;
        $body = 'your item :'.$ingredient->id.'-'.$ingredient->name .' amount is '.$ingredient->current_amount.' ,please refill it!';
        $subject = 'Stock item below 50% !!';
        $to = env('ADMIN_EMAIL','admin@restro.com');
        
        Mail::raw($body, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });
    }
}

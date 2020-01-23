<?php

namespace App\Mail;

use App\User;
use App\ShoppingList;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShoppingListEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $shoppingList;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $shoppingList)
    {
        $this->user = $user;
        $this->shoppingList = $shoppingList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.shopping-list');
    }
}

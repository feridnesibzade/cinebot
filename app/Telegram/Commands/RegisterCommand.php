<?php

namespace App\Telegram\Commands;

use App\Telegram\Conversations\RegisterConversation;
use Telegram\Bot\Commands\Command;

class RegisterCommand extends Command
{
    protected string $name = 'register';
    protected string $description = 'Start registration flow';

    public function handle($arguments, Dialogs $dialogs): void
    {
        $this->startConversation(new RegisterConversation());
    }
}

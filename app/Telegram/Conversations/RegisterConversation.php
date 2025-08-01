<?php

namespace App\Telegram\Conversations;

use Telegram\Bot\Commands\Conversation;

class RegisterConversation extends Conversation
{
    public function start(): void
    {
        // First step
        $this->say('Conversation started');
        $this->next('nextStep');
    }

    public function nextStep(): void
    {
        $this->say('And finished!');
        $this->stop();
    }
}

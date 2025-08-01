<?php

namespace App\Console\Commands;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetWebHook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-web-hook {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        (new TelegraphBot())->registerWebhook()->send();
//        $response = Telegram::setWebhook([
//            'url' => $this->argument('url'),
//        ]);
//        $this->info($response);
    }
}

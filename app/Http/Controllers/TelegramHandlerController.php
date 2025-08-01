<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramHandlerController extends Controller
{
    /**
     * https://api.telegram.org/bot7846399776:AAHUiSN0XiASnFETqDzkg8L55PYH010_9M0
     * @throws Exception
     */
    public function handle(Request $request)
    {
        Log::warning('BOT : ', $request->all());
        Telegram::commandsHandler(true);
//        return match ($request->message['text']) {
//            '/register' => $this->relay(route('api.telegram.register'), $request),
//            '/start'    => '',
//            default     => response('OK', 200)
//        };
    }

    /**
     * @throws Exception
     */
    protected function relay(string $uri, Request $original): Response
    {
        $cloned = Request::create(
            $uri,
            $original->method(),
            $original->all(),
            $original->cookies->all(),
            [],
            $original->server->all()
        );
        return app()->handle($cloned);
    }
}

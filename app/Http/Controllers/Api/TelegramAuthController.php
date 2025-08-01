<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramAuthController extends Controller
{
    public function register(Request $request)
    {
        Telegram::sendMessage([
            'chat_id'      => $request->message['chat']['id'],
            'text'         => "📞 Göndərmək üçün telefon nömrənizi paylaşın.",
            'reply_markup' => json_encode([
                'keyboard'          => [
                    [
                        [
                            'text'            => '📲 Telefonu paylaş',
                            'request_contact' => true
                        ]
                    ]
                ],
                'one_time_keyboard' => true,
                'resize_keyboard'   => true,
            ]),
        ]);
    }
}

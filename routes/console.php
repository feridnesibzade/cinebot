<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('inspire-ai', function () {
    $response = Prism::text()
        ->using(Provider::Gemini, 'gemini-2.0-flash')
        ->withPrompt('Display an inspiring quote randomly. only give me result it self dont give me any other additional text.')
        ->asText()->text;
    $this->info($response);
});

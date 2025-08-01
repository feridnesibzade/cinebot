<?php

namespace App\Filament\Resources\ScenarioResource\Pages;

use App\Filament\Resources\ScenarioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;

class CreateScenario extends CreateRecord
{
    protected static string $resource = ScenarioResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),

            $this->getCreateAnotherFormAction(),
            $this->getCancelFormAction(),

            Actions\Action::make('aiRequest')
                ->label('Ask Ai')
                ->color('info')
                ->keyBindings(['ctrl+enter'])
                ->action(function (self $livewire, array $data) {
                    $description = strip_tags($livewire->form->getState()['description']);
                    $stream      = Prism::text()
                        ->using(Provider::Gemini, 'gemini-2.0-flash')
//                        ->withMessages([
//                                new UserMessage('Here is the document from a local path', [
//                                    Document::fromText(
//                                        text: 'You are scenario bot.',
//                                        title: 'Settings' // optional
//                                    ),
//                                ]),
//                            ]
//                        )
                        ->withPrompt('You are scenario bot.')
                        ->withPrompt($description)
                        ->asStream();                       // ← generator of StreamChunk objects :contentReference[oaicite:1]{index=1}

                    // reset buffer
                    $livewire->aiStream = '';

                    /** @var StreamChunk $chunk */
                    foreach ($stream as $chunk) {
                        // 1) accumulate the text so we can later write it to the form
                        $livewire->aiStream .= $chunk->text;

                        // 2) push the new piece to the browser immediately
                        $livewire->stream(
                            to: 'aiStream',                 // must match wire:stream target
                            content: $chunk->text,          // append
                        // replace: true               // use this if you prefer overwriting
                        );
                        ob_flush();
                        flush();
                    }

                    // when the stream is finished, copy the full answer into the form field
                    $livewire->form->fill([
                        'ai_response' => $livewire->aiStream,
                    ]);
                }),
        ];
    }
}

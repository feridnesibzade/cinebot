<?php
// app/Console/Commands/MakeTelegramBlueprint.php
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeTelegramBlueprint extends GeneratorCommand
{
    protected $name = 'make:telegram';
    protected $description = 'Generate a Telegram Command or Conversation class';

    protected function getStub()
    {
        return $this->option('conversation')
            ? base_path('/stubs/telegram-conversation.stub')
            : base_path('/stubs/telegram-command.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->option('conversation')
            ? $rootNamespace . '\Telegram\Conversations'
            : $rootNamespace . '\Telegram\Commands';
    }

    protected function getOptions()
    {
        return [
            ['conversation', 'c', null, 'Generate a Conversation instead of a Command'],
        ];
    }

    protected function buildClass($name)
    {
        $class = parent::buildClass($name);
        $snake = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', class_basename($name)));
        return str_replace('{{ snakeName }}', $snake, $class);
    }
}

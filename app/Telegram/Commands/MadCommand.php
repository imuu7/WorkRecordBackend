<?php

// namespace Vendor\App\Commands;



// namespace App\Http\Controllers;

// use Telegram;

// use Telegram\Actions;
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

use Telegram\Bot\Commands\Actions;
use Throwable;


class MadCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "mad";

    /**
     * @var string Command Description
     */
    protected $description = "Start Command to get you started";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        // This will send a message using `sendMessage` method behind the scenes to
        // the user/chat id who triggered this command.
        // `replyWith<Message|Photo|Audio|Video|Voice|Document|Sticker|Location|ChatAction>()` all the available methods are dynamically
        // handled when you replace `send<Method>` with `replyWith` and use the same parameters - except chat_id does NOT need to be included in the array.
        $this->replyWithMessage(['text' => 'MAD歡迎使用鈾-235 合約網格交易機器人 請選擇您的功能']);

        // This will update the chat status to typing...
        // $this->replyWithChatAction(['action' => Actions::TYPING]);

        // // This will prepare a list of available commands and send the user.
        // // First, Get an array of all registered commands
        // // They'll be in 'command-name' => 'Command Handler Class' format.
        // $commands = $this->getTelegram()->getCommands();

        // // Build the list
        // $response = '';
        // foreach ($commands as $name => $command) {
        //     $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        // }

        // // Reply with the commands list
        // $this->replyWithMessage(['text' => $response]);

        // // Trigger another command dynamically from within this command
        // // When you want to chain multiple commands within one or process the request further.
        // // The method supports second parameter arguments which you can optionally pass, By default
        // // it'll pass the same arguments that are received for this command originally.
        // $this->triggerCommand('subscribe');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Telegram;
use App\Models\tel_msg_log;
class Telegram_Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function index(Request $request)
    {
        // $response = Telegram::getMe();

        // $botId = $response->getId();
        // $firstName = $response->getFirstName();
        // $username = $response->getUsername();
        $upd = Telegram::getWebhookUpdates();
        $new_log = new tel_msg_log();
        $orogin_message = $upd->message;
        $new_log->message_id = $orogin_message->message_id;
        $new_log->msg_from_id = $orogin_message->from->id;
        $new_log->msg_from_body = $orogin_message->from;
        $new_log->chat_body = $orogin_message->chat;
        $new_log->chat_text = $orogin_message->text;
        $new_log->message_date = $orogin_message->date;
        $new_log->save();
        
        
        // Log::info('rec', ['xx' => $upd]);
        // Log::info('REQ', ['xx' => $request]);
        Telegram::addCommand(\App\Telegram\Commands\StartCommand::class);
        // Telegram::addCommand(\App\Telegram\Commands\MadCommand::class);



        $update = Telegram::commandsHandler(true);
        // Telegram::replyWithMessage(['text' => '歡迎使用鈾-235 合約網格交易機器人 請選擇您的功能']);



            // $telegram = new Api(Telegram::getAccessToken());
            $update = Telegram::getWebhookUpdates();
            $chat_id = $update->getMessage()->getChat()->getId();
            $text= $update->getMessage()->getText();

            
            $response = Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => 'zzzzzzz'
            ]);

            // $messageId = $response->getMessageId();


        //         $this->replyWithMessage(['text' => 'Поздравляем! Вы успешно добавили событие!!!']);
        //     $this->replyWithMessage(['text' => 'Название - ' . $text]);
        // $this->replyWithMessage(['text' => 'Chat Id - ' . $chat_id]);



        //  $this->replyWithMessage(['text' => $messageId]);

        
        return "ok";

    }
}

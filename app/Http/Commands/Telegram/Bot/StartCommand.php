<?php

namespace App\Http\Commands\Telegram\Bot;

use Telegram\Bot\Commands\Command;
use Telegram;
use App\TelegramChat;
/**
 * Class HelpCommand.
 */
class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['startcommand'];

    /**
     * @var string Command Description
     */
    protected $description = 'Start Command, get Chat_id.';

    /**
     * {@inheritdoc}
     */
    public function handle()
    
    {
        $response = $this->getUpdate();

        //$getChatId = $response[0]["message"]["chat"];

        $text = 'Hallo bosku.';

        $text = json_encode($response["message"]["chat"]["id"]);
        $text = ($response["message"]["text"]);


        if ($response["message"]["chat"]["type"] != "private")
        {
            if ( ($response["message"]["chat"]["title"] == env('TELEGRAM_GROUP_NAME')) )
            {
              $deleteallroom = TelegramChat::truncate();

              $addroom = new TelegramChat();
              $addroom->chat_id = $response["message"]["chat"]["id"];
              $addroom->save();

              $text = "Berhasil mendaftarkan group.";
            }
            else
            {
              $text = "Maaf group ini tidak terdaftar.";
            }
        
        }
        else
        {
          $text = "Hanya berjalan didalam group";
        }
        
        $this->replyWithMessage(compact('text'));
        //$this->replyWithMessage(compact('response'));

    }
}

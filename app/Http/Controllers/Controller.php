<?php

namespace App\Http\Controllers;

use App\CActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mail;
use App\Mail\NotificationDeletedEmail;
use App\TelegramChat;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function createlog($log, $category, $notif = "activity")
    {
        $table = new CActivityLog();
        $table->log = $log;
        $table->category = $category;
        $table->save();

        //if ($category=="delete")
        //{
        //    //Mail::to('restugurupromosindo.adm@gmail.com')->queue(new NotificationDeletedEmail($log));
        //    Mail::to('rizkiakbarzein@gmail.com')->queue(new NotificationDeletedEmail($log));
        //}

        if ((($category == "delete") || ($category == "edit")) && ($notif == "telegram")) {
            $telegram = TelegramChat::first();
            $chatId = $telegram->chat_id;

            //$messagetelegram = Telegram::sendMessage([
            //    'chat_id' => $chatId,
            //    'text' => $log
            //]);


            $token = env('TELEGRAM_BOT_TOKEN', "1260628438:AAF4RRb1D4BMRtN0xDjZbMzUsqVk-rFfSYY");
            $client = new Client();
            $response = $client->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'form_params' => [
                  'chat_id' => $chatId,
                  'text' => $log,
                ]
            ]);
        }


        return true ;
    }
}

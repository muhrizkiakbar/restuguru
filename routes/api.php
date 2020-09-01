<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/bot/getupdates', function() {
    $updates = Telegram::getUpdates();
    //return (json_encode($updates["message"]["chat"]["id"]));
    $response = ($updates);
    $getChatId = $response[0]["message"]["chat"];
    return ($getChatId);
});

Route::post('setwebhook', function(){
  $response = Telegram::setWebhook(['url' => 'https://8518ab26cff8.ngrok.io/YHr1bq5qGFPYBzaWYc51ajt0sIQ2DcGQhNkPKMSjZ0DPzMLJlOOGUXxX0mbYZKxxF3ihX5dkMLtKo3t1JgJNSjhn6hv6ZqlryPBZcwNL2NsKrcQ8F3kMXRW8kCG64Nbd/webhook']);
  dd($response);
});

Route::post('deletewebhook', function(){
  $response = Telegram::removeWebhook();
  dd($response);
});

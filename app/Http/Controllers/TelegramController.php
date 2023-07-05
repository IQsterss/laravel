<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HubstaffService;

class TelegramController extends Controller
{
    protected $hubstaffService;

    public function __construct(HubstaffService $hubstaffService)
    {
        $this->hubstaffService = $hubstaffService;
    }

    public function inbound(Request $request){
        \Log::info($request->all());

        //get telegram chat_id and reply to
        $chat_id = $request->message['from']['id'];
        $reply_to_message =$request->message ['message_id'];
        \Log::info("chat_id:{$chat_id}");
        \Log::info("reply_to_message: {$reply_to_message}");
        $text = '';

        //if first time ->send first time message
        if(!cache()->has("chat_id_{$chat_id}")){
            $text="Welcome to Al+S+_b0t 🤖\r\n";

            cache()->put("chat_id_{$chat_id}",true,now()->addMinute(60));

        //if chat is photo->Extract text from photo 
         } else{
            $text="Al+S+_b0t 🤖\r\n\r\n";

        }   
    // Обработка команды /employees
    if ($request->message['text'] === '/employees') {
        // Получение данных о времени отслеживания сотрудников от Hubstaff
        $employeesTime = $this->hubstaffService->getWeeklyTrackingTime();
        foreach ($employeesTime as $userId => $trackedTime) {
            $employeesName = $this->hubstaffService->getNameID($userId);
            $employeesTimeUser = $trackedTime / 3600;
            $text .=  "User ID: $employeesName, Tracked Time: $employeesTimeUser hours\r\n";
            \Log::info("User ID: $employeesName, Tracked Time: $employeesTimeUser hours\r\n");
        }
        
    }

    

    // Отправка сообщения в Telegram
    $result = app('telegram_bot')->sendMessage($text, $chat_id, $reply_to_message);

    return response()->json($result, 200);
    }

}
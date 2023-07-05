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
        //\Log::info($employeesTime);
        foreach ($employeesTime as $userId => $trackedTime) {
            $employeesName = $this->hubstaffService->getNameID($userId);
            $totalSeconds = $trackedTime;
            $totalDays = floor($totalSeconds / (24 * 60 * 60));
            $remainingSeconds = $totalSeconds % (24 * 60 * 60);
            $employeesTimeUser = $totalDays . " дней, " .gmdate("H:i", $trackedTime). " часов и минут";
            $text .=  "Имя работника : $employeesName, затраченное время : $employeesTimeUser \r\n\n";
            //\Log::info("User ID: $employeesName, Tracked Time: $employeesTimeUser hours\r\n");
        }
        //$project = $this->hubstaffService->getProject();
        //\Log::info("User ID: $project");
        // $projectI = $this->hubstaffService->getWeeklyTrackingTimeProject();
        // \Log::info("User ID: $projectI");

        
    }
    if ($request->message['text'] === '/project') {
        // Получение данных о времени отслеживания сотрудников от Hubstaff
        $employeesTimeProject = $this->hubstaffService->getWeeklyTrackingTimeProject();
        //\Log::info($employeesTimeProject);
        foreach ($employeesTimeProject as $projectId => $trackedTimeProject) {
            //\Log::info($projectId);
            $employeesLabel = $this->hubstaffService->getProjectName($projectId);
            //\Log::info("User ID: $employeesLabel, Tracked Time: $trackedTimeProject hours\r\n");
            $totalSeconds = $trackedTimeProject ;
            $totalDays = floor($totalSeconds / (24 * 60 * 60));
            $remainingSeconds = $totalSeconds % (24 * 60 * 60);
            $employeesTimeProject = $totalDays . " дней, " .gmdate("H:i", $trackedTimeProject). " часов и минут";
            $text .=  "Название проекта: $employeesLabel, затраченное время : $employeesTimeProject \r\n\n";
            //\Log::info("User ID: $employeesLabel, Tracked Time: $employeesTimeProject hours\r\n");
        }
        //$project = $this->hubstaffService->getProject();
        //\Log::info("User ID: $project");
        // $projectI = $this->hubstaffService->getWeeklyTrackingTimeProject();
        // \Log::info("User ID: $projectI");

        
    }

    

    // Отправка сообщения в Telegram
    $result = app('telegram_bot')->sendMessage($text, $chat_id, $reply_to_message);

    return response()->json($result, 200);
    }

}
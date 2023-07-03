<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function inbound(Request $request){
        \Log::info($request->all());

        //get telegram chat_id and reply to
        $chat_id = $request->message['from']['id'];
        $reply_to_message =$request->message ['message_id'];
        \Log::info("chat_id:{$chat_id}");
        \Log::info("reply_to_message: {$reply_to_message}");


        //if first time ->send first time message
        if(!cache()->has("chat_id_{$chat_id}")){
            $text="Welcome to Al+S+_b0t 🤖\r\n";
            $text.="Please upload a IMAGE and enjoy the magic";

            cache()->put("chat_id_{$chat_id}",true,now()->addMinute(60));

        //if chat is photo->Extract text from photo 
        }else{
            $text="Al+S+_b0t 🤖\r\n\r\n Please upload an IMAGE!";

        }   

        //telegram service ->sendMessage($chat_id,$text,$r,$reply_to_message)
        //$telegram_bot=new \App\Services\TelegramBot();
        $result = app('telegram_bot')->sendMessage($text,$chat_id,$reply_to_message);

        return response()->json($result,200);
    }

}


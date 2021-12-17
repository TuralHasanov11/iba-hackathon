<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\NewMessage;

class MessageController extends Controller
{

    public function send(Request $request){
       
        $data = $request->validate([
            'from'=>'required',
            'text'=>'required',
            'is_operator'=>'boolean'
        ]);
        
        $message = Message::create([
            'from'=>$data['from'],
            'is_operator'=>$data['is_operator'],
            'text'=>$data['text']
        ]);

        broadcast(new NewMessage($message));
        return response()->json($message);
    }

    public function get(Request $request){
        // Message::where('from',$request->uuid)->update(['read'=>true]);
        
        $messages = Message::where('from', $request->uuid)->get();

        return response()->json($messages);
    }

}

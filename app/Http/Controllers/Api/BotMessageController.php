<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BotMessage;
use App\Http\Controllers\Controller;


class BotMessageController extends Controller
{
    public function index(Request $request){
        if($request->filled('parent')){
            $msgs = BotMessage::where('parent',$request->parent)->get();
            foreach ($msgs as $key => $msg) {
                $msg->children = BotMessage::where('parent',$msg->id)->count();
            }

            return response()->json($msgs);
            
        }
        
        return response()->json(BotMessage::whereNull('parent')->get());
    }
}

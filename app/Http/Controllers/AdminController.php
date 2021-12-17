<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BotMessage;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function botMessagesCreate(){
        
        return view('messages.create',[
            'messages'=>BotMessage::all()
        ]);
    }

    public function botMessagesStore(Request $request){
        BotMessage::create($request->validate([
            'body'=>'required',
            'parent'=>'required|integer'
        ]));

        return redirect()->route('bot_messages.create');
    }
}

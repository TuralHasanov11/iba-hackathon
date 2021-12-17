<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function customers(){
        \DB::statement("SET SQL_MODE=''");

        return response()->json(\DB::table('messages')
            ->groupBy('from')
            ->get());
    }
}

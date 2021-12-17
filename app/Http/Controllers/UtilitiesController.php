<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UtilitiesController extends Controller
{
    public function index(){

    }

    public function paymentHistory(){
        
        return view('utilities.payment_history');
    }


   
}

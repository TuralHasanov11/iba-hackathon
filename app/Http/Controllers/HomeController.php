<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 


class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['temp']);
    }

    
    public function index(Request $request)
    {
        if (!$request->session()->has('uuid')) {
            $request->session()->put('uuid', (string) Str::uuid());
        }
        
        return view('welcome');
        // return view('home');
    }

    public function temp(Request $request){
        // $this->categories();
        $this->clients();
        // $this->subscriptions();
        // $this->transactions();
    }

    public function categories(){
        $csvString = File::get(public_path('csv/categories.csv'));
        $csvArr = str_getcsv($csvString, "\n");
        $csvHeadings = array_map(function($h){
            return trim($h," \"");
        }, explode(",",array_shift($csvArr)));
        
        // dd($csvHeadings);
        $csvArr = array_map(function($i){
            return array_map(function($j){
                return trim($j," \"");
            }, explode(',',$i));
        }, $csvArr);

        $csvArr = array_map(function($i){
            return array_merge(array_slice($i,0,3),[implode(',',array_slice($i,3))]);
        },$csvArr);

        dd($csvArr);
    }


    public function clients(){
        $csvString = File::get(public_path('csv/clients.csv'));
       
        $csvArr = str_getcsv($csvString, "\n");
        $csvHeadings = array_map(function($h){
            return trim($h," \"");
        }, explode(",",array_shift($csvArr)));
        
        // dd($csvHeadings);
        $csvArr = array_map(function($i){
            return array_map(function($j){
                return trim($j," \"");
            }, explode(',',$i));
        }, $csvArr);

        // $csvArr = array_map(function($i){
        //     return array_merge(array_slice($i,0,3),[implode(',',array_slice($i,3))]);
        // },$csvArr);

        dd($csvArr);
    }
}

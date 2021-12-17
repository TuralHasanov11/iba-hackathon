<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class UtilitiesController extends Controller
{
    public function paymentHistory(Request $request, $card){

        // check card number

        $categories = array_column($this->categories(), 'name', 'id');
        $transactions = $this->transactions();
        
        array_walk($transactions, function (& $item) use ($categories){
            $item['category']['name'] = $categories[$item['product_category']];
            $item['category']['id'] = $item['product_category'];
        });

        return response()->json($transactions);
    }

    public function paymentCategories(Request $request){

        // check card number

        $categories = array_column($this->categories(), 'name', 'id');

        return response()->json($categories);
    }

    public function transactions(){
        $csvString = File::get(public_path('csv/transactions1.csv'));
        $csvArr = str_getcsv($csvString, "\n");
        $csvHeadings = array_map(function($h){
            return trim($h," \"");
        }, explode(",",array_shift($csvArr)));
        
        $csvArr = array_map(function($i){
            return array_map(function($j){
                return trim($j," \"");
            }, explode(',',$i));
        }, $csvArr);

        array_walk($csvArr, function (& $item) use ($csvHeadings){
            foreach ($item as $key => $value) {
                $item[$csvHeadings[$key]] = $value;
                unset($item[$key]);
            }
        });

        return $csvArr;
    }

    public function categories(){
        $csvString = File::get(public_path('csv/categories.csv'));
        $csvArr = str_getcsv($csvString, "\n");
        $csvHeadings = array_map(function($h){
            return trim($h," \"");
        }, explode(",",array_shift($csvArr)));
        
        $csvArr = array_map(function($i){
            return array_map(function($j){
                return trim($j," \"");
            }, explode(',',$i));
        }, $csvArr);

        $csvArr = array_map(function($i){
            return array_merge(array_slice($i,0,3),[implode(',',array_slice($i,3))]);
        },$csvArr);

        array_walk($csvArr, function (& $item) use ($csvHeadings){
            foreach ($item as $key => $value) {
                $item[$csvHeadings[$key]] = $value;
                unset($item[$key]);
            }
        });

        return $csvArr;
    }
}

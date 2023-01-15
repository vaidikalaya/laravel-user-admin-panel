<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    
    public function index(){
        $arry=['a','b','c','d','a','b','a','c','d'];
        $newArry=[];
        $removalIndex=[];
        
        for($i=0;$i<count($arry);$i++){

            if(count($arry)>1){
                $removalIndex=[];
                foreach($arry as $index=>$arr){
                    if($arry[$i]===$arr){
                        array_push($removalIndex,$index);
                    }
                }
                if($i===1){
                    
                }
            }

            if(count($removalIndex)>=1){
                foreach($removalIndex as $in){
                    array_push($newArry,$arry[$removalIndex[0]]);
                    unset($arry[$in]);
                }
            }
        }
        dd($newArry);
    }    

}

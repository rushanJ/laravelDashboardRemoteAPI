<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        if ($request->session()->has('lastId')) $lastId= $request->session()->get('lastId');
        else $lastId=0;
        $dataList=Http::get("http://ivivaanywhere.ivivacloud.com/api/Asset/Asset/All?apikey=SC:demo:64a9aa122143a5db&max=10&last=$lastId")->json();//getData from Remote API
        $labels=[];//lable set
        $data=[];//data set for lables
        $array = array();
        foreach($dataList as $item) { //foreach element in $array
            // Update array
            $itemId = $item['AssetCategoryID']; 
            if (isset($array[$itemId])){// check availability (if yes +1 else start with 0)
                $replacement = array($item['AssetCategoryID'] =>$array[$itemId]+1);
                $array=array_replace($array,  $replacement);
            }
            else{
                $replacement = array($item['AssetCategoryID'] => 1);
                $array=array_replace($array,  $replacement);
            }
        }
  
        // finalizing lable\data
        foreach ($array as $key => $value) {
            array_push($labels, $key);
            array_push($data, $value);
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $data);
    }

    
}
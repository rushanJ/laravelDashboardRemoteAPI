<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Equipment extends Controller
{
    function index()
    {
        $data= Http::get('http://ivivaanywhere.ivivacloud.com/api/Asset/Asset/All?apikey=SC:demo:64a9aa122143a5db&max=100&last=0')->json();//getData from Remote API
        
        // Tile variables
        $operational=0; 
        $nonoperational=0;
        
        foreach($data as $item) { //foreach element in array
            // Update Tile Variable
            if ($item['OperationalStatus']=="Operational")  $operational++;
            else$nonoperational++;
        }        
        return view('welcome',['data'=>$data,'operational'=>$operational,'nonoperational'=>$nonoperational]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Equipment extends Controller
{
    public function index( Request $request)
    {
        if ($request->has('lastId')) $lastId=$request->lastId;
        else $lastId=0;

        $nextId=$lastId+10;
        if ($lastId==0) $previousId=0;
        else $previousId=$lastId-10;
        $data= Http::get("http://ivivaanywhere.ivivacloud.com/api/Asset/Asset/All?apikey=SC:demo:64a9aa122143a5db&max=10&last=$lastId")->json();//getData from Remote API
         $request->session()->put('lastId',$lastId);//store last Id
        // Tile variables
        $operational=0; 
        $nonoperational=0;
        foreach($data as $item) { //foreach element in array
            // Update Tile Variable
            if ($item['OperationalStatus']=="Operational")  $operational++;
            else$nonoperational++;
        }        
        return view('welcome',['data'=>$data,'operational'=>$operational,'nonoperational'=>$nonoperational ,'nextId'=>$nextId,'previousId'=>$previousId]);
    }
}

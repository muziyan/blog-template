<?php

namespace App\Http\Controllers;

use App\WebInfo;
use Carbon\Traits\Date;
use Illuminate\Http\Request;

class WebInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $date = Date("Y-m-d");
        $access = WebInfo::where("created_at",$date)->first();
        if (!$access){
            $query = [
                "access" => 0,
                "created_at" => $date
            ];
            $access = WebInfo::create($query);
            $access['access'] = $access->access + 1;
            $access->save();
        }else{
            $access['access'] = $access->access + 1;
            $access->save();
        }

    }


    public function upload(Request $request){


        $file_path = $this->uploadImage($request['image'],"article");

        return response([
           "file_path" => $file_path
        ]);

    }

}

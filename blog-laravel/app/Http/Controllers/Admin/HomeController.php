<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Photos;
use App\Models\Section;
use App\Models\User;
use App\WebInfo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $usersCount = count(User::all());
        $sectionCount = count(Section::all());
        $articleCount = count(Article::all());
        $photoCount = count(Photos::all());

        $accesses = [];
        for ($i = 7; $i > 0; $i--) {
            $date = Date("Y-m-d", strtotime("-{$i} day"));
            $accesses[] = WebInfo::where("created_at", $date)->first();
        }


        foreach ($accesses as $item){
            $item['created_at'] = explode("-",$item['created_at']);
        }


        return view("admin.home",[
            "userCount" => $usersCount,
            "sectionCount" => $sectionCount,
            "articleCount" => $articleCount,
            "photoCount"  => $photoCount,
            "access_data" => $accesses
        ]);
    }
}

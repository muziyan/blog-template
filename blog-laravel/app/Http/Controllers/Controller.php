<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showSuccess($url,$data = []){
        $data[] = [
            "show_list" => true
        ];
        return redirect($url)->with($data);
    }


    public function showNotFound($url){
        return redirect($url)->with([
            "error" => "not data found!",
            "show_list" => true
        ]);
    }

    public function uploadImage($file,$filename = null){

        $filename = $filename ? $filename : "carousel";

        // 生成文件上传文件夹
        $folder_name = "uploads/images/$filename.".date("Ym/d",time());
        // 上传路径
        $upload_path = public_path() . "/" . $folder_name;
        // 获取文件后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: "png";
        // 生成文件名称
        $filename = time()."_".Str::random(10).'.'.$extension;
        // 移动文件
        $file->move($upload_path,$filename);
        // 组成文件路径
        $file_path = $folder_name.'/'.$filename;

        return $file_path;
    }

}

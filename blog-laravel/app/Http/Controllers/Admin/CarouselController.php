<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselPost;
use App\Http\Requests\CarouselPut;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class CarouselController extends Controller
{

    public function index()
    {
        $carousels = Carousel::all();

        return view("admin.carousel",[
            "carousels" => $carousels,
            "update_data" => false
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CarouselPost $request)
    {
        /*  文件上传 */

        $file_path = $this->uploadImage($request['image_url']);

        $validated = $request->validated();
        $validated['image_url'] = $file_path;
        Carousel::create($validated);
        return $this->showSuccess("admin/carousel",[
            "notice" => "create carousel success!",
            "show_list" => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Carousel $carousel)
    {
        $carousels = Carousel::all();

        if ($carousel){
            return view("admin.carousel",[
                'update_data' => $carousel,
                "carousels" => $carousels
            ]);
        }

        return $this->showNotFound("admin/carousel");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(CarouselPut $request, Carousel $carousel)
    {
        if ($carousel){
            $validated = $request->validated();
            if ($request['image_url']) {
                $file_path = $this->uploadImage($request['image_url']);
                $validated['image_url'] = $file_path;
            }else{
                unset($request['image_url']);
            }

            $carousel->update($validated);
            return $this->showSuccess("admin/carousel",[
                "show_list" => true
            ]);
        }

        return $this->showNotFound("admin/carousel");
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Carousel $carousel)
    {
        if ($carousel){
            $carousel->delete();
            return $this->showSuccess("admin/carousel",[
                "notice" => "delete carousel success!",
                "show_list" => true
            ]);
        }

        return $this->showNotFound("admin/carousel");
    }
}

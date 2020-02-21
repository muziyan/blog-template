<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PhotoPost;
use App\Models\Photos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $photos = Photos::paginate(10);

        return view("admin.photo",[
            "photos" => $photos,
            "update_data" => false,
            "show_list" => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(PhotoPost $request)
    {
        $validated = $request->validated();

        $file_path = $this->uploadImage($request['photo_url'],'photos');

        $validated['photo_url'] = $file_path;

        Photos::create($validated);
        return $this->showSuccess("admin/photo")->with([
            "show_list" => false,
            "notice" => "create photo success!"
        ]);

    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {

        if ($photo = Photos::find($id)){

            $photos = Photos::paginate(10);

            return view("admin.photo",[
                "photos" => $photos,
                "update_data" => $photo
            ]);

        }

        return $this->showNotFound("admin/photo");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photos  $photos
     * @return \Illuminate\Http\Response
     */
    public function edit(Photos $photos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        if ($photo = Photos::find($id)){

            $req = $request->all();

            if ($request['photo_url']) $req['photo_url'] = $this->uploadImage($request['photo_url'],"photos");

            $photo->update($req);

            return $this->showSuccess("admin/photo")->with([
                "show_list" => false,
                "notice" => "update photo success!"
            ]);
        }

        return $this->showNotFound("admin/photo");
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $photo = Photos::find($id);
        if ($photo){
            $photo->delete();

            return $this->showSuccess("admin/photo")->with([
                "show_list" => false,
                "notice" => "delete photo success!"
            ]);
        }

        return $this->showNotFound("admin/photo");
    }
}

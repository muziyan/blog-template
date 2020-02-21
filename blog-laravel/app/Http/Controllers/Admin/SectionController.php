<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SectionPost;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $sections = Section::all();

        return view("admin.section",[
            "sections" => $sections,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(SectionPost $request)
    {
        if ($validted = $request->validated()){

            Section::create($validted);

            return $this->showSuccess("admin/section",[
                "notice" => "create section success!",
                "show_list" => "true"
            ]);
        }

        return $this->showNotFound("admin/section");
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Section $section)
    {

        if ($section){
            $sections = Section::all();

            return view("admin.section",[
                "sections" => $sections,
                "update_data" => $section
            ]);

        }

        return $this->showNotFound("admin/section");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Section $section)
    {
        if ($section){

            $section->update($request->all());

            return $this->showSuccess("admin/section",[
                "notice" => "update section success!",
                "show_list" => "true"
            ]);
        }

        return $this->showNotFound("admin/section");

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Section $section)
    {
        if ($section){
            $section->delete();

            return $this->showSuccess("admin/section",[
                "notice" => "create section success!",
                "show_list" => "true"
            ]);
        }
        return $this->showNotFound("admin/section");
    }
}

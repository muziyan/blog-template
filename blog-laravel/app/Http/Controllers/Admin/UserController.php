<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view("admin.user",[
            "users" => $users,
            "update_data" => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create(UserPost $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(UserPost $request)
    {
        $validated = $request->validated();
        $validated['password'] = Crypt::encryptString($validated['password']);
        User::create($validated);
        return redirect("admin/user")->with([
            "notice" => "create user success!",
            "show_list" => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        if ($user = User::find($id)){
            $users = User::all();
            return view("admin.user",[
                "update_data" => $user,
                "users" => $users
            ]);
        }

        return $this->showNotFound("admin/user");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        if ($user = User::find($id)){
            if ($request['password']) {
                $request['password'] = Crypt::encryptString($request['password']);
            }else{
                unset($request['password']);
            }
            $user->update($request->all());
            return redirect("admin/user")->with([
                "notice" => "update user success!",
                "show_list" => true
            ]);
        }

        return $this->showNotFound("admin/user");
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        if ($user = User::find($id)){
            $user->delete();
            return $this->showSuccess("admin/user",[
                "notice" => "delete user success!",
                "show_list" => true
            ]);
        }
        return $this->showNotFound("admin/user");
    }
}

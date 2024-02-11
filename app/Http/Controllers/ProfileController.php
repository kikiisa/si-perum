<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\services\UploadService;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $path = "data/profile/";
    private $upload;
    public function __construct()
    {
        $this->upload = new UploadService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return response()->view("backend.profile.index-user", [
                "title" => "Profile - SIPERUM",
            ]);
        } else {
            return response()->view("backend.profile.index-admin", [
                "title" => "Profile - SIPERUM",
            ]);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $data = User::find(Auth::user()->id);
            $profile = $request->file("profile");
            if ($request->old != "" && $request->password != "") {

                if (Hash::check($request->old, Auth::user()->password)) {
                    $request->validate([
                        "name" => "sometimes|required",
                        "username" => "sometimes|required",
                        "email" => "sometimes|required|email",
                        "profile" => "sometimes|required|mimes:jpg,jpeg,png|max:2048",
                        "old" => "required",
                        "password" => "required|min:8",
                        "confirm" => "required|same:password"
                    ]);
                    $data->update([
                        "name" => $request->name,
                        "username" => $request->username,
                        "email" => $request->email,
                        "profile" => $profile  ? $this->upload->removedFilesProfile($profile,$data->profile,$this->path) : $data->profile  ,
                        'password' => Hash::make($request->password)
                    ]);
                    if ($data) {
                        return redirect()->back()->with('success', 'Data dan Password berhasil diperbarui');
                    } else {
                        return redirect()->back()->with('error', 'Data dan Password gagal diperbarui');
                    }
                } else {
                    return redirect()->back()->with('error', 'Password lama tidak sesuai');
                } 
            } else {
                $request->validate([
                    "name" => "sometimes|required",
                    "username" => "sometimes|required",
                    "email" => "sometimes|required|email",
                    "profile" => "sometimes|required|mimes:jpg,jpeg,png|max:2048",
                ]);
                $data->update([
                    "name" => $request->name,
                    "username" => $request->username,
                    "email" => $request->email,
                    "profile" => $profile  ? $this->upload->removedFilesProfile($profile, $data->profile, $this->path) : $data->profile,

                ]);
                if ($data) {
                    return redirect()->back()->with(["success" => "Data Berhasil Diupdate"]);
                } else {
                    return redirect()->back()->with(["error" => "Data Gagal Diupdate"]);
                }
            }
        } else {
            
            $data = Operator::find(Auth::guard('operators')->user()->id);
            if ($request->old != "" && $request->password != "") {

                if (Hash::check($request->old, Auth::guard('operators')->user()->password)) {
                    $request->validate([
                        "name" => "sometimes|required",
                        "username" => "sometimes|required",
                        "email" => "sometimes|required|email",
                        "old" => "required",
                        "password" => "required|min:8",
                        "confirm" => "required|same:password"
                    ]);
                    $data->update([
                        "name" => $request->name,
                        "username" => $request->username,
                        "email" => $request->email,
                        'password' => Hash::make($request->password)
                    ]);
                    if ($data) {
                        return redirect()->back()->with('success', 'Data dan Password berhasil diperbarui');
                    } else {
                        return redirect()->back()->with('error', 'Data dan Password gagal diperbarui');
                    }
                } else {
                    return redirect()->back()->with('error', 'Password lama tidak sesuai');
                } 
            } else {
                $request->validate([
                    "name" => "sometimes|required",
                    "username" => "sometimes|required",
                    "email" => "sometimes|required|email",
                    
                ]);
                $data->update([
                    "name" => $request->name,
                    "username" => $request->username,
                    "email" => $request->email,

                ]);
                if ($data) {
                    return redirect()->back()->with(["success" => "Data Berhasil Diupdate"]);
                } else {
                    return redirect()->back()->with(["error" => "Data Gagal Diupdate"]);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

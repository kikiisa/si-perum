<?php

namespace App\Http\Controllers;

use App\Models\ProfilePemetaan;
use App\services\UploadService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return response()->view("backend.user.index",[
            "title" => "Master Vendor - SIPERUM",
            "data"  => User::all()
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
        $data = User::all()->where("uuid",$id)->first();
        return response()->view("backend.user.edit", [
            "title" =>  $data->name . " - SIPERUM",
            "data"  => $data
        ]);
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
        
        $data = User::find($id);
        $profile = $request->file("profile");
        if ($request->old != "" && $request->password != "") {

            if (Hash::check($request->old,$data->password)) {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProfilePemetaan::all()->where("user_id",$id);
        $default = User::all()->where("username","default")->first();
        DB::update("UPDATE profile_pemetaans SET user_id = ? WHERE user_id = ?", [$default->id,$id]);
        $user = User::find($id);
        File::delete($user->profile);
        $user->delete();
        if($user)
        {
            return redirect()->back()->with(["success" => "Data Berhasil Di Hapus"]);
        }else{
            return redirect()->back()->with(["error" => "Data Gagal Di Hapus"]);
        }
    }
}

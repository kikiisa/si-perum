<?php

namespace App\Http\Controllers;
use App\services\UploadService;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    private $upload;
    private $path = "data/settings/";
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
        return response()->view("backend.settings.index",[
            "title" => "Pengaturan - SIPERUM",
            "data" => Pengaturan::all()->first()
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
        $request->validate([
            "title" => "required",
            "subtitle" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "deskripsi" => "required",
            "logo" => "sometimes|required|mimes:png,jpg,jpeg|max:2048",
            "strukture" => "sometimes|required|mimes:png,jpg,jpeg|max:2048",
        ],[
            "title.required" => "Judul harus diisi",
            "subtitle.required" => "Sub Judul harus diisi",
            "email.required" => "Email harus diisi",
            "phone.required" => "Nomor Telepon harus diisi",
            "address.required" => "Alamat harus diisi",
            "deskripsi.required" => "Deskripsi harus diisi",
            "logo.required" => "Logo harus diisi",
            "strukture.required" => "Struktur Organisasi harus diisi",
            "logo.mimes" => "Logo harus berformat png,jpg,jpeg",
            "strukture.mimes" => "Struktur Organisasi harus berformat png,jpg,jpeg",
            "logo.max" => "Ukuran logo maksimal 2 MB",
            "strukture.max" => "Ukuran Struktur Organisasi maksimal 2 MB",
        ]);
        $data = Pengaturan::find($id);
        $data->update([
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "deskripsi" => $request->deskripsi,
            "logo" => $request->file("logo") ? $this->upload->removedFilesProfile($request->file("logo"), $data->logo, $this->path) : $data->logo,
            "strukture" => $request->file("strukture") ? $this->upload->removedFilesProfile($request->file("strukture"), $data->strukture, $this->path) : $data->strukture
        ]);
        if($data)
        {
            return redirect()->route("pengaturan.index")->with("success","Data Berhasil");
        }else{
            return redirect()->route("pengaturan.index")->with("error","Data Gagal Disimpan");
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

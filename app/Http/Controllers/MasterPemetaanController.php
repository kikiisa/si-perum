<?php

namespace App\Http\Controllers;

use App\Models\ProfilePemetaan;
use Illuminate\Http\Request;
use App\services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Profiler\Profile;

class MasterPemetaanController extends Controller
{
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
        return response()->view("backend.pemetaan.index", [
            "title" => 'Master Pemetaan - SIPERUM',
            "data" => Auth::check() ? ProfilePemetaan::with("vendor")->where("user_id", Auth::user()->id)->get() : ProfilePemetaan::with("vendor")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    const SYARAT = [
        "Izin Lingkungan Setempat" => "izin_lingkungan_setempat",
        "RUTR" => "rutr",
        "Izin Pemanfaatan Tanah" => "izin_pemanfaatan_tanah",
        "Izin Prinsip" => "izin_prinsip",
        "Izin Lokasi" => "izin_lokasi",
        "Izin Badan Lingkungan Hidup" => "izin_badan_lingkungan_hidup",
        "Izin Dampak Lalu Lintas" => "izin_dampak_lalu_lintas",
    ];

    public function create()
    {
        return response()->view("backend.pemetaan.create", [
            "title" => "Tambah Pemetaan - SIPERUM",
            "syarat" => self::SYARAT
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama_perumahan" => "required",
            "alamat_perumahan" => "required",
            "deskripsi" => "required",
            "luas_lahan" => "required|numeric",
            "longitude" => "required",
            "latitude" => "required",
            "izin_lingkungan_setempat" => "required|mimes:pdf|max:2048",
            "rutr" => "required|mimes:pdf|max:2048",
            "izin_pemanfaatan_tanah" => "required|mimes:pdf|max:2048",
            "izin_prinsip" => "required|mimes:pdf|max:2048",
            "izin_lokasi" => "required|mimes:pdf|max:2048",
            "izin_badan_lingkungan_hidup" => "required|mimes:pdf|max:2048",
            "izin_dampak_lalu_lintas" => "required|mimes:pdf|max:2048",
            "profile" => "required|mimes:jpg,jpeg,png,webp|max:2048",
        ], [
            "required" => ":attribute harus diisi",
            "numeric" => ":attribute harus berupa angka",
            "profile.mimes" => ":attribute harus berupa jpg, jpeg, png, webp",
            "izin_lingkungan_setempat.mimes" => ":attribute harus berupa pdf",
            "rutr.mimes" => ":attribute harus berupa pdf",
            "izin_pemanfaatan_tanah.mimes" => ":attribute harus berupa pdf",
            "izin_prinsip.mimes" => ":attribute harus berupa pdf",
            "izin_lokasi.mimes" => ":attribute harus berupa pdf",
            "izin_badan_lingkungan_hidup.mimes" => ":attribute harus berupa pdf",
            "izin_dampak_lalu_lintas.mimes" => ":attribute harus berupa pdf",
            "profile.max" => ":attribute maksimal 2 MB",
            "max" => ":attribute maksimal 2 MB"
        ]);
        $data = ProfilePemetaan::create([
            "uuid" => Uuid::uuid4()->toString(),
            "nama_perumahan" => $request->nama_perumahan,
            "alamat_perumahan" => $request->alamat_perumahan,
            "deskripsi" => $request->deskripsi,
            "luas_lahan" => $request->luas_lahan,
            "longitude" => $request->longitude,
            "latitude" => $request->latitude,
            "izin_lingkungan_setempat" => $this->upload->uploadFile($request->file("izin_lingkungan_setempat")),
            "rutr" => $this->upload->uploadFile($request->file("rutr")),
            "izin_pemanfaatan_tanah" => $this->upload->uploadFile($request->file("izin_pemanfaatan_tanah")),
            "izin_prinsip" => $this->upload->uploadFile($request->file("izin_prinsip")),
            "izin_lokasi" => $this->upload->uploadFile($request->file("izin_lokasi")),
            "izin_badan_lingkungan_hidup" => $this->upload->uploadFile($request->file("izin_badan_lingkungan_hidup")),
            "izin_dampak_lalu_lintas" => $this->upload->uploadFile($request->file("izin_dampak_lalu_lintas")),
            "user_id" => Auth::user()->id,
            "profile" => $this->upload->uploadImage($request->file("profile")),
        ]);
        if ($data) {
            return redirect()->route("master-pemetaan.index")->with("success", "Data pemetaan berhasil ditambahkan");
        } else {
            return redirect()->back()->with("error", "Data pemetaan gagal ditambahkan");
        }
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
        $data = ProfilePemetaan::all()->where("uuid", $id)->first();
        return response()->view("backend.pemetaan.edit", [
            "title" => "Edit Pemetaan - SIPERUM",
            "data" => $data,
            "syarat" => self::SYARAT
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
        $data = ProfilePemetaan::find($id);
        $request->validate([
            "nama_perumahan" => "required",
            "alamat_perumahan" => "required",
            "deskripsi" => "required",
            "luas_lahan" => "required|numeric",
            "longitude" => "required",
            "latitude" => "required",
            "izin_lingkungan_setempat" => "sometimes|required|mimes:pdf|max:2048",
            "rutr" => "sometimes|required|mimes:pdf|max:2048",
            "izin_pemanfaatan_tanah" => "sometimes|required|mimes:pdf|max:2048",
            "izin_prinsip" => "sometimes|required|mimes:pdf|max:2048",
            "izin_lokasi" => "sometimes|required|mimes:pdf|max:2048",
            "izin_badan_lingkungan_hidup" => "sometimes|required|mimes:pdf|max:2048",
            "izin_dampak_lalu_lintas" => "sometimes|required|mimes:pdf|max:2048",
            "status" => "sometimes|required",
            "note" => "sometimes",
            "profile" => "sometimes|mimes:jpg,jpeg,png,webp|max:2048"
        ], [
            "required" => ":attribute harus diisi",
            "numeric" => ":attribute harus berupa angka",
            "profile.mimes" => ":attribute harus berupa jpg, jpeg, png, webp",
            "izin_lingkungan_setempat.mimes" => ":attribute harus berupa pdf",
            "rutr.mimes" => ":attribute harus berupa pdf",
            "izin_pemanfaatan_tanah.mimes" => ":attribute harus berupa pdf",
            "izin_prinsip.mimes" => ":attribute harus berupa pdf",
            "izin_lokasi.mimes" => ":attribute harus berupa pdf",
            "izin_badan_lingkungan_hidup.mimes" => ":attribute harus berupa pdf",
            "izin_dampak_lalu_lintas.mimes" => ":attribute harus berupa pdf",
            "profile.max" => ":attribute maksimal 2 MB",
            "max" => ":attribute maksimal 2 MB"
        ]);
        $data->update([
            "nama_perumahan" => $request->nama_perumahan,
            "alamat_perumahan" => $request->alamat_perumahan,
            "deskripsi" => $request->deskripsi,
            "luas_lahan" => $request->luas_lahan,
            "longitude" => $request->longitude,
            "latitude" => $request->latitude,
            // Other data remains the same
            "izin_lingkungan_setempat" => $request->file("izin_lingkungan_setempat")
                ? $this->upload->removedFiles($request->file("izin_lingkungan_setempat"),$data->izin_lingkungan_setempat)
                : $data->izin_lingkungan_setempat,

            "rutr" => $request->file("rutr")
                ? $this->upload->removedFiles($request->file("rutr"),$data->rutr)
                : $data->rutr,

            "izin_pemanfaatan_tanah" => $request->file("izin_pemanfaatan_tanah")
                ? $this->upload->removedFiles($request->file("izin_pemanfaatan_tanah"),$data->izin_pemanfaatan_tanah)
                : $data->izin_pemanfaatan_tanah,

            "izin_prinsip" => $request->file("izin_prinsip")
                ? $this->upload->removedFiles($request->file("izin_prinsip"),$data->izin_prinsip)
                : $data->izin_prinsip,

            "izin_lokasi" => $request->file("izin_lokasi")
                ? $this->upload->removedFiles($request->file("izin_lokasi"),$data->izin_lokasi)
                : $data->izin_lokasi,

            "izin_badan_lingkungan_hidup" => $request->file("izin_badan_lingkungan_hidup")
                ? $this->upload->removedFiles($request->file("izin_badan_lingkungan_hidup"),$data->izin_badan_lingkungan_hidup)
                : $data->izin_badan_lingkungan_hidup,

            "izin_dampak_lalu_lintas" => $request->file("izin_dampak_lalu_lintas")
                ? $this->upload->removedFiles($request->file("izin_dampak_lalu_lintas"),$data->izin_dampak_lalu_lintas)
                : $data->izin_dampak_lalu_lintas,
            "note" => $request->note ? $request->note : $data->note,
            "profile" => $request->file("profile") ? $this->upload->removedFilesImage($request->file("profile"),$data->profile) : $data->profile,
            "status" => $request->status ? $request->status : $data->status
        ]);

        if ($data) {
            return redirect()->route("master-pemetaan.index")->with("success", "Data pemetaan berhasil diubah");
        } else {
            return redirect()->back()->with("error", "Data pemetaan gagal diubah");
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
        $data = ProfilePemetaan::find($id);
        $this->upload->removedOneFiles($data->izin_lingkungan_setempat);
        $this->upload->removedOneFiles($data->rutr);
        $this->upload->removedOneFiles($data->izin_pemanfaatan_tanah);
        $this->upload->removedOneFiles($data->izin_prinsip);
        $this->upload->removedOneFiles($data->izin_lokasi);
        $this->upload->removedOneFiles($data->izin_badan_lingkungan_hidup);
        $this->upload->removedOneFiles($data->izin_dampak_lalu_lintas);
        $data->delete();
        if($data)
        {
            return redirect()->route("master-pemetaan.index")->with("success", "Data pemetaan berhasil dihapus");
        }else{
            return redirect()->back()->with("error", "Data pemetaan gagal dihapus");
        }
    }

    public function ApiMasterPemetaan()
    {
        $data = ProfilePemetaan::all();
        if($data->count() > 0)
        {
            return response()->json([
                "status" => TRUE,
                "data" => $data->where("status","accepted")
            ]);
        }else{
            return response()->json([
                "status" => FALSE,
                "data" => []
            ]);
        }
    }

    public function ApiChartMasterPemetaan()
    {
       $bulan = [1,2,3,4,5,6,7,8,9,10,11,12];
       $data = [];
       foreach($bulan as $b)
       {
           $data[] = ProfilePemetaan::whereMonth("created_at",$b)->whereYear("created_at",date("Y"))->where("status","accepted")->count();
       }
       return response()->json($data);
    }
}

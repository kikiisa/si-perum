<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\ProfilePemetaan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        $data = ProfilePemetaan::all();
        if($request->has("q"))
        {
            $data = ProfilePemetaan::where("nama_perumahan","like","%".$request->q."%")->paginate(5);
            return response()->view("frontend.index", [
                "title" => "Beranda",
                'totalData' => $data->count(),
                'ditolak'   => $data->where("status", "rejected")->count(),
                'diterima'   => $data->where("status", "accepted")->count(),
                'pending'   => $data->where("status", "pending")->count(),
                'data'      => $data,
                "app" =>    Pengaturan::all()->first(),
            ]);
        }else{
           
            return response()->view("frontend.index", [
                "title" => "Beranda",
                'totalData' => $data->count(),
                'ditolak'   => $data->where("status", "rejected")->count(),
                'diterima'   => $data->where("status", "accepted")->count(),
                'pending'   => $data->where("status", "pending")->count(),
                'data'      => ProfilePemetaan::with("vendor")->where("status","accepted")->paginate(5),
                "app" =>    Pengaturan::all()->first(),
            ]);

        }
    }

    public function detail($id)
    {
        $data = ProfilePemetaan::with("vendor")->where("uuid",$id)->first();
        return response()->view("frontend.detail", [
            "title" => $data->nama_perumahan,
            "data" => $data,
            "app" => Pengaturan::all()->first(),
        ]);
    }

    public function about(){
        return response()->view("frontend.about", [
            "title" => "Tentang Kami - SIPERUM",
            "app" => Pengaturan::all()->first(),
        ]);
    }
}

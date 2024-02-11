<?php

namespace App\Http\Controllers;

use App\Models\ProfilePemetaan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data = ProfilePemetaan::all();
        return response()->view("frontend.index", [
            "title" => "Beranda",
            'totalData' => $data->count(),
            'ditolak'   => $data->where("status", "rejected")->count(),
            'diterima'   => $data->where("status", "accepted")->count(),
            'pending'   => $data->where("status", "pending")->count(),
            'data'      => ProfilePemetaan::with("vendor")->where("status","accepted")->paginate(5),
        ]);
    }

    public function detail($id)
    {
        $data = ProfilePemetaan::with("vendor")->where("uuid",$id)->first();
        return response()->view("frontend.detail", [
            "title" => $data->nama_perumahan,
            "data" => $data
        ]);
    }
}

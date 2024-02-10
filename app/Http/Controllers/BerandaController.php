<?php

namespace App\Http\Controllers;

use App\Models\ProfilePemetaan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data = ProfilePemetaan::all();
        return response()->view("frontend.layouts", [
            "title" => "Beranda",
            'totalData' => $data->count(),
            'ditolak'   => $data->where("status", "rejected")->count(),
            'diterima'   => $data->where("status", "accepted")->count(),
            'pending'   => $data->where("status", "pending")->count(),
        ]);
    }
}

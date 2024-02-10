<?php

namespace App\Http\Controllers;

use App\Models\ProfilePemetaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(!Auth::check())
        {
            return response()->view("backend.dashboard.index-admin",[
                'title' => 'Dashboard - SIPERUM Admin'
            ]);
        }else{  
            $data = ProfilePemetaan::all()->where("user_id",Auth::user()->id);
            return response()->view("backend.dashboard.index-user",[
                'title' => 'Dashboard - SIPERUM User',
                'totalData' => $data->count(), 
                'ditolak'   => $data->where("status","rejected")->count(),
                'diterima'   => $data->where("status","accepted")->count(),
                'pending'   => $data->where("status","pending")->count(),
            ]);
        }
    }
}

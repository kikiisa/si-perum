<?php

namespace App\Http\Controllers;

use App\Models\ProfilePemetaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Auth::check() ? ProfilePemetaan::all()->where("user_id",Auth::user()->id) : ProfilePemetaan::all();
        if(!Auth::check())
        {
            return response()->view("backend.dashboard.index-admin",[
                'title' => 'Dashboard - SIPERUM Admin',
                'totalData' => $data->count(), 
                'ditolak'   => $data->where("status","rejected")->count(),
                'diterima'   => $data->where("status","accepted")->count(),
                'pending'   => $data->where("status","pending")->count(),
            ]);
        }else{  
            
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

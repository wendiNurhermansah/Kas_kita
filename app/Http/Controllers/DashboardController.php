<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;


class DashboardController extends Controller
{
    public function index(){
        $anggota = Anggota::all()->count();
        return view('Home.dashboard', compact('anggota'));
    }
}

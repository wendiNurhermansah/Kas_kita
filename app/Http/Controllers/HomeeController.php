<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Kas;

class HomeeController extends Controller
{
    public function index(){
        $anggota = Anggota::all()->count();
        $sum = Kas::where('status', '1')->sum('nominal');
        $sum2 = Kas::where('status', '2')->sum('nominal');
        //
        $saldo = $sum-$sum2;
        // dd($saldo);
        return view('Home.dashboard', compact(
            'anggota',
            'sum',
            'sum2',
            'saldo'
        ));
    }
}

<?php

namespace App\Http\Controllers\laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Models\Kas;
use DateTime;

class LaporanController extends Controller
{
    // laporan masuk
   public function Masuk(){
       return view('laporan.Masuk');
   }

   public function cetakPDF(Request $request){
        if($request->tanggaldari == '' || $request->tanggalsampai == ''  || !isset($request->tanggaldari))
            return abort(403, "inputan tanggal tidak boleh kosong");

    $data = Kas::where('status', '1')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->get();
    $tanggal = $request->tanggaldari;
    $tanggal2 = $request->tanggalsampai;
    $total = Kas::where('status', '1')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->sum('nominal');



    // return view('layouts.print', [
    // 'data' => $data,
    // 'tanggal' => $tanggal,
    // 'tanggal2' => $tanggal2,
    // 'total' => $total
    // ]);

    $pdf = PDF::loadview('pdf.print', [
    'data' => $data,
    'tanggal' => $tanggal,
    'tanggal2' => $tanggal2,
    'total' => $total
    ]);
    return $pdf->download('laporan-masuk.pdf');
   }

    //Laporan Keluar
    public function Keluar(){
        return view('laporan.Keluar');
    }


    public function printPDF(Request $request){
        if($request->tanggaldari == '' || $request->tanggalsampai == ''  || !isset($request->tanggaldari))
            return abort(403, "inputan tanggal tidak boleh kosong");

    $data = Kas::where('status', '2')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->get();
    $tanggal = $request->tanggaldari;
    $tanggal2 = $request->tanggalsampai;
    $total = Kas::where('status', '2')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->sum('nominal');



    // return view('pdf.cetak', [
    // 'data' => $data,
    // 'tanggal' => $tanggal,
    // 'tanggal2' => $tanggal2,
    // 'total' => $total
    // ]);

    $pdf = PDF::loadview('pdf.cetak', [
    'data' => $data,
    'tanggal' => $tanggal,
    'tanggal2' => $tanggal2,
    'total' => $total
    ]);
    return $pdf->download('laporan-keluar.pdf');
   }

    // Laporan Rekafitulasi
    public function Rekaf(){
        return view ('laporan.rekaf');
    }

    public function cetakRekaf(Request $request){
            if($request->tanggaldari == '' || $request->tanggalsampai == ''  || !isset($request->tanggaldari))
                return abort(403, "inputan tanggal tidak boleh kosong");

                // 1. rentan tanggal

                $begin = new DateTime($request->tanggaldari);
                $end = new DateTime($request->tanggalsampai);
                $diff = $begin->diff($end);
                dd($diff);
                $tgl[]= [$diff];



                //data
                $data = [];
                for($i = 0; $i<count($tgl); $i++){
                    $kas_masuk = Kas::where('status', '1')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->get();
                    $kas_keluar = Kas::where('status', '2')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->get();
                    $data[] = [
                        'tgl' => $tgl[$i],
                        'kas_masuk' =>$kas_masuk,
                        'kaskeluar' =>$kas_keluar
                    ];
                }
                dd($data);

    // $data = Kas::where('status', '1')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->get();
    // $data1 = Kas::where('status', '2')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->get();
    $tanggal = $request->tanggaldari;
    $tanggal2 = $request->tanggalsampai;
    $total = Kas::where('status', '1')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->sum('nominal');
    $total1 = Kas::where('status', '2')->whereBetween('tanggal', [$request->tanggaldari, $request->tanggalsampai])->sum('nominal');

    return view('pdf.rekaf', [
    'data' => $data,
    'tanggal' => $tanggal,
    'tanggal2' => $tanggal2,
    'total' => $total,
    'total1' => $total1
    ]);

    $pdf = PDF::loadview('pdf.cetak', [
        'data' => $data,
        'data1' => $data1,
        'tanggal' => $tanggal,
        'tanggal2' => $tanggal2,
        'total' => $total,
        'total1' => $total1
        ]);
        return $pdf->download('laporan-Rekafitulasi.pdf');

    }
}

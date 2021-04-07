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
        $namaBulan = ["Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        return view ('laporan.rekaf', compact('namaBulan'));
    }

    public function cetakRekaf(Request $request){

        $y = (int)$request->tahun;
        $m = (int)$request->bulan;
        $d = (int) '01';
        $tgl = $y.'-'.$m.'-'.$d;
        $end = date('t', strtotime($tgl));

        $m = sprintf("%02d", $m);

        // Menapilkan tgl pada bulan tersebut kas masuk
        $subtotal_kasMasuk= 0;
        $subtotal_kasKeluar =0;
        for($i=1; $i<=$end; $i++){
            $labels[] = sprintf("%02d", $i);
            // echo sprintf("%02d", $i);
            $h = kas::select('nominal')
                ->where('status', '=', '1')
                ->whereDate('tanggal', $y.'-'.$m.'-'.sprintf("%02d", $i))
                ->sum('nominal');

            $j = kas::select('nominal')
                ->where('status', '=', '2')
                ->whereDate('tanggal', $y.'-'.$m.'-'.sprintf("%02d", $i))
                ->sum('nominal');

            $serie[] = [
                'label' => sprintf("%02d", $i),
                'kas_masuk' => $h,
                'kas_keluar' => $j
            ];
                // $serie[]['label'] = sprintf("%02d", $i);
                // $serie[]['kas_masuk'] = $h;
                // $serie[]['kas_keluar'] = $j;
            $subtotal_kasMasuk += $h;

            $subtotal_kasKeluar += $j;
        }





    //    dd($labels);

        // return view('pdf.rekaf', [
        //     'h' => $h,
        //     'subtotal_kasMasuk' => $subtotal_kasMasuk,
        //     'subtotal_kasKeluar' => $subtotal_kasKeluar,
        //     'serie' => $serie,
        //     'y' => $y,
        //     'm' => $m
        //     ]);
        $pdf = PDF::loadview('pdf.rekaf', [
            'h' => $h,
            'subtotal_kasMasuk' => $subtotal_kasMasuk,
            'subtotal_kasKeluar' => $subtotal_kasKeluar,
            'serie' => $serie,
            'y' => $y,
            'm' => $m
            ]);
            return $pdf->download('laporan-rekafitulasi.pdf');
        // // dd($labels);
    }
}

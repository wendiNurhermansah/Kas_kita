<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kas;

class KaskeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum1 = Kas::where('status', '1')->sum('nominal');
        // dd($sum1);
        $sum2 = Kas::where('status', '2')->sum('nominal');
        // dd($sum2);
        return view('data.kasKeluar', compact('sum1', 'sum2'));
    }

    public function api()
    {
        $data = Kas::where('status', '2')->get();
        return DataTables::of($data)

            ->addIndexColumn()
            ->rawColumns([''])
            ->toJson();
    }

    public function tambahKasKeluar(){
        return view ('data.tambahKasKeluar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
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
            'tanggal' => 'required',
            'keterangan' => 'required',
            'nominal' => 'required'
        ]);

        $tanggal = $request->tanggal;
        $keterangan = $request->keterangan;
        $nominal = $request->nominal;
        $sum1 = Kas::where('status', '1')->sum('nominal');
        $sum2 = Kas::where('status', '2')->sum('nominal');

        // select
        // $saldo_sebelum = Anggota::whereid($tmanggota_id)->first()->jumlah_kas;
        // $saldo_sebelum = $request->jumlah_kas;

        // jumlah saldo
        $saldo_setelah = $sum1 - $sum2 ;
        // dd($saldo_setelah);

        // uodate member
        // $anggota = Anggota::find($tmanggota_id);

        // $anggota->update([
        //     'jumlah_kas' => $saldo_setelah
        // ]);



        $tmkas = new Kas();
        // $tmkas -> tmanggota_id = $tmanggota_id;
        $tmkas -> tanggal = $tanggal;
        $tmkas -> keterangan = $keterangan;
        $tmkas -> nominal = $nominal;
        $tmkas -> saldo_sesudah = $saldo_setelah;
        // $tmkas -> saldo_sebelum = $saldo_sebelum;
        $tmkas -> status = 2;
        $tmkas -> save();

        return response()->json([
            'message' => 'Data berhasil di simpan'
        ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kas;


class KasmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum = Kas::where('status', '1')->sum('nominal');
        // dd($sum);
        return view('data.kasMasuk', compact('sum'));
    }

    public function api()
    {
        $data = Kas::where('status', '1')->orderBy('tmanggota_id')->get();
        return DataTables::of($data)
            ->editColumn('tmanggota_id',function($p) {
                if ($p->Anggota != null) {
                    return $p->Anggota->nama;
                } else {
                    return '-';
                }
            })
            ->addIndexColumn()
            ->rawColumns([''])
            ->toJson();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Anggota::all();
        return view('data.tambahKas', compact('anggota'));
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
            'tmanggota_id' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'nominal' => 'required'
        ]);

        $tmanggota_id = $request->tmanggota_id;
        $tanggal = $request->tanggal;
        $keterangan = $request->keterangan;
        $nominal = $request->nominal;

        // select
        $saldo_sebelum = Anggota::whereid($tmanggota_id)->first()->jumlah_kas;
        // $saldo_sebelum = $request->jumlah_kas;

        // jumlah saldo
        $saldo_setelah = $saldo_sebelum + $nominal ;

        // uodate member
        $anggota = Anggota::find($tmanggota_id);

        $anggota->update([
            'jumlah_kas' => $saldo_setelah
        ]);



        $tmkas = new Kas();
        $tmkas -> tmanggota_id = $tmanggota_id;
        $tmkas -> tanggal = $tanggal;
        $tmkas -> keterangan = $keterangan;
        $tmkas -> nominal = $nominal;
        $tmkas -> saldo_sesudah = $saldo_setelah;
        $tmkas -> saldo_sebelum = $saldo_sebelum;
        $tmkas -> status = 1;
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
        Kas::destroy($id);
        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}

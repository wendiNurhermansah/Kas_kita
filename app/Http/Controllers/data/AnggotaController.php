<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Anggota::all();
        return view ('data.anggota', compact(
            'anggota',
        ));
    }

    public function api()
    {
        $data = Anggota::all();
        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='" . route('Data.anggota.edit', $p->id) . "' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
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
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin'     => 'required',
            'no_hp'    => 'required|numeric|max:12',

        ]);
        $nama = $request->nama;
        $alamat = $request->alamat;
        $jenis_kelamin = $request->jenis_kelamin;
        $no_hp = $request->no_hp;


        $tmanggota = new Anggota();
        $tmanggota-> nama = $nama;
        $tmanggota-> alamat = $alamat;
        $tmanggota-> jenis_kelamin = $jenis_kelamin;
        $tmanggota-> no_hp = $no_hp;
        $tmanggota->save();

        return response()->json([
            'message' => 'Data berhasil tersimpan.'
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
        $anggota = Anggota::find($id);
        return view('data.edit', compact('anggota'));
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

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin'     => 'required',
            'no_hp'    => 'required|unique|max:12',

        ]);

        $input = $request->all();
        $anggota = Anggota::findOrFail($id);
        $anggota->update($input);
        // $nama = $request->nama;
        // $alamat = $request->alamat;
        // $jenis_kelamin = $request->jenis_kelamin;
        // $no_hp = $request->no_hp;

        // $anggota->update([
        //     'nama' => $nama,
        //     'alamat' => $alamat,
        //     'jenis_kelamin' => $jenis_kelamin,
        //     'no_hp' => $no_hp
        // ]);

        return redirect('Data/anggota')->with('status', 'data Anggota berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::destroy($id);
        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}

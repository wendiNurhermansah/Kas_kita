<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'tmkas';
    protected $fillable = ['id', 'tmanggota_id', 'tanggal','keterangan', 'nominal', 'saldo_sebelum', 'saldo_sesudah', 'status', 'created_at', 'updated_at'];

    public function Anggota(){
        return $this->belongsTo(Anggota::class, 'tmanggota_id');
    }
}

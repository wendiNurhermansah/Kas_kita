<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'tmanggota';
    protected $fillable = ['id'. 'nama', 'alamat', 'jenis_kelamin', 'no_hp', 'jumlah_kas', 'created_at', 'updated_at'];

}

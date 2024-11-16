<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class M_SuratKeluar extends Model
{
    use HasFactory;
    // mematikan auto increment
    public $incrementing = false;

    // tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 't_surat_keluar';

    protected $fillable = ['no_surat', 'id_bagian', 'tujuan_surat', 'isi_singkat', 'jenis_surat', 'perihal_surat', 'tgl_surat', 'tgl_terima', 'tgl_arsip', 'keterangan', 'file_surat_keluar'];

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();
        // generate UUID pada saat model sedang dibuat
        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function bagian(){
        return $this->belongsTo(MBagian::class, 'id_bagian');
    }
}

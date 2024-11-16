<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class M_SuratMasuk extends Model
{
    use HasFactory;
    // mematikan auto increment
    public $incrementing = false;

    // tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 't_surat_masuk';

    protected $fillable = ['no_surat', 'asal_surat', 'isi_singkat', 'jenis_surat', 'perihal_surat', 'tgl_surat', 'tgl_terima', 'tgl_arsip', 'status_disposisi', 'keterangan', 'file_surat_masuk'];

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();
        // generate UUID pada saat model sedang dibuat
        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    /**
     * Relasi ke model M_Disposisi.
     * Setiap surat masuk bisa memiliki satu disposisi.
     */
    public function disposisi(){
        return $this->hasOne(M_Disposisi::class, 'id_surat_masuk');
    }
}

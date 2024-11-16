<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class M_Disposisi extends Model
{
    use HasFactory;
    // mematikan auto increment
    public $incrementing = false;

    // tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 't_disposisi';
    protected $fillable = ['id_bagian', 'isi_disposisi', 'sifat', 'catatan', 'id_surat_masuk'];
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
     * Relasi ke model MBagian.
     * Setiap disposisi memiliki satu bagian.
     */
    public function bagian(){
        return $this->belongsTo(MBagian::class, 'id_bagian');
    }

    /**
     * Relasi ke model MSuratMasuk.
     * Setiap disposisi mengacu pada satu surat masuk.
     */
    public function suratMasuk(){
        return $this->belongsTo(M_SuratMasuk::class, 'id_surat_masuk');
    }
}

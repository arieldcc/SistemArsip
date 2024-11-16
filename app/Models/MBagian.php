<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MBagian extends Model
{
    use HasFactory;
    // mematikan auto increment
    public $incrementing = false;

    // tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 't_bagian';
    protected $fillable = ['nama_bagian'];
    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();
        // generate UUID pada saat model sedang dibuat
        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

}

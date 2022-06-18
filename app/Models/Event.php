<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $primaryKey = "id_event";
    public $timestamps = false;
    protected $dates = ['tanggal_event'];
    protected $fillable = [
        'nama_event',
        'tanggal_event',
        'informasi_event',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pemilik',
        'no_telfon',
        'alamat',
        'nama_hewan',
        'ciri_khusus_hewan',
        'umur_kucing',
        'jenis_kucing',
        'check_in',
        'check_out',
        'berat',
        'jenis_kelamin_kucing',
        'treatment_id',
        'service_id',
    ];
}

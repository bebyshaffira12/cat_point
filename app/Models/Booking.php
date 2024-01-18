<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'treatment_id', 
        'service_id',
        'created_at',
        'updated_at',
    ];
    
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

    public function treatment(): HasOne
    {
        return $this->hasOne(Treatment::class, 'id', 'treatment_id');
    }

    public function service(): HasOne
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}

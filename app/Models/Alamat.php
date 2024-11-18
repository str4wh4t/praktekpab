<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'province_id',
        'city_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function city()
    {
        return $this->hasOne(City::class, 'city_id', 'city_id');
    }
    public function province()
    {
        return $this->hasOne(Province::class, 'city_id', 'province_id');
    }
}

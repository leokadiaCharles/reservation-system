<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;

class Hotel extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_name',
        'hotel_location',
        
    ];

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }


}

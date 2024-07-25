<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'table_id',
        'user_id',
        'booking_date',
        'booking_time',
        'transaction_id', 
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    // Relationship with Payment model
    public function payment(): HasOne
    {
        return $this->hasOne(payement::class);
    }

    // Relationship with Table model
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

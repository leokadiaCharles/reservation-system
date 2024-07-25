<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Table extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'table_size',
        'table_type',
        'table_amount',
        'table_image',
        'is_available',
    ];

    /**
     * Get the hotel that owns the table.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}

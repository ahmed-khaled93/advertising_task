<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ad_id',
        'tag',
    ];

    /**
     * Get the ad that owns the tag.
     */
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}

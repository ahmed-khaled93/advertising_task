<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
    ];

    /**
     * Get the ads for the type.
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}

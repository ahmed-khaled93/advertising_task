<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'category_id', 'type_id', 'title', 'description', 'start_date'
    ];

    /**
     * Get the user(advertiser) that owns the ad.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the ad.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the type that owns the ad.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the tags for the ad.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

}

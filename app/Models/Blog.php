<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['title', 'body', 'image', 'published_at'];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope('published', function (Builder $builder) {
    //         $builder->whereNotNull('published_at');
    //     });
    // }
}

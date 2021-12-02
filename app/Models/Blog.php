<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['title', 'body', 'image', 'published_at'];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function uploadImage($image)
    {
        Storage::put($image->name, file_get_contents($image));
        $this->update(['image' => $image->name]);
    }
}

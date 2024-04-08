<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'cover_image',
        'category_id'
    ];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    //un post può avere una sola categoria

    public function category(): BelongsTo
    {
        return $this->belongsTo( Category::class );
    }

    //un singolo post è collegato a più tags

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}

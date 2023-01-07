<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'abstract'];

    /**
     * タグの一覧（表示ラベルのみ）.
     */
    public function tagLabels()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    /**
     * タグの一覧.
     */
    public function tags()
    {
        return $this->hasMany(BookTag::class);
    }
}

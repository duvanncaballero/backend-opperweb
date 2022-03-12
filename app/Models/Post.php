<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'content',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'category_id',
    ];

    /**
     * The attributes that should be format.
     *
     * @var array
     */
    protected $casts = [
        'created_at'     => 'date:Y-M-d H:i:s A',
        'updated_at'     => 'date:Y-M-d H:i:s A',
    ];

    /**
     * Relations model categories.
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relations model comments.
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

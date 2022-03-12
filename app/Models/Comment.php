<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
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
        'post_id',
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
     * Relations model posts.
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

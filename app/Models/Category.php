<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
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
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

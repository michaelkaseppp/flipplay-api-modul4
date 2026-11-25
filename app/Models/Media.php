<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'title',
        'type',
        'genre',
        'release_year',
        'description',
    ];

    protected $casts = [
        'release_year' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

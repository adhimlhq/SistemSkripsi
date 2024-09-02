<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'kemajuan_I',
        'ulasan_I',
        'update_I',
        'kemajuan_II',
        'ulasan_II',
        'update_II',
        'kemajuan_III',
        'ulasan_III',
        'update_III',
        'kemajuan_IV',
        'ulasan_IV',
        'update_IV',
    ];

    public function topics()
    {
        return $this->morphOne(Topic::class, 'topicable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    public $table = 'seminar';

    protected $fillable = [
        'user_id',
        'topic_id',
        'seminar',
        'nama_moderator',
        'ruangan',
    ];

    public function topics()
    {
        return $this->morphOne(Topic::class, 'topicable');
    }

    public function users()
    {
        return $this->morphOne(User::class, 'userable');
    }
}

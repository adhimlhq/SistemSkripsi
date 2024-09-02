<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    public $table = "logbook";

    protected $fillable = [
        'id',
        'topic_id',
        'user_id',
        'dospem_id',
        'waktu',
        'ruangan',
        'catatan',
        'status_lb',
    ];

    public function users()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function topics()
    {
        return $this->morphOne(Topic::class, 'topicable');
    }
}

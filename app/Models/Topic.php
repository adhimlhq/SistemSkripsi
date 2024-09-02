<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'abstrak',
        'sks',
        'dosen1_id',
        'dosen2_id',
        'pkm',
        'proposal',
        'surat_tugas',
        'status_id',
    ];

    public function users()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function topicable()
    {
        return $this->morphTo();
    }
}

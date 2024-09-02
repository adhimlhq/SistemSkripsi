<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'program_id',
        'jurusan',
        'alamat',
        'gender',
        'avatar',
        'status_ta'
    ];

    public function users()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

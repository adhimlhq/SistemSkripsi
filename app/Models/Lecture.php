<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    public $table = "lecturers";

    protected $fillable = [
        'user_id',
        'previllege',
        'ruangan',
    ];


    public function users()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function field()
    {
        return $this->belongsToMany(Field::class);
    }
}

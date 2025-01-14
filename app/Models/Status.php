<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $table = 'status';

    protected $fillable = [
        'id', 'text_stat'
    ];

    public function topic()
    {
        return $this->belongsToMany(Topic::class);
    }
}

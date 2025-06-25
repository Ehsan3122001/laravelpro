<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'teacher_id',
        'category_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

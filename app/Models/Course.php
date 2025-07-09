<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost', 'teacher_id','category_id'];


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }


    public function curricula()
    {
        return $this->hasMany(Curricula::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

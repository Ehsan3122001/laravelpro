<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curricula extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

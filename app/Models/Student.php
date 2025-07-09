<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseInfos()
    {
        return $this->hasMany(CourseInfo::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function money()
    {
        return $this->hasOne(Money::class);
    }
}

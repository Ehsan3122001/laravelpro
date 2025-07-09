<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'curricula_id'];

    public function curricula()
    {
        return $this->belongsTo(Curricula::class);
    }
}

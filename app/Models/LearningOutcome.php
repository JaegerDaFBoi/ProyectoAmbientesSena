<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningOutcome extends Model
{
    use HasFactory;

    protected $table = 'learning_outcomes';

    public function competencia()
    {
        return $this->belongsTo(Competence::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competences';

    public function programa()
    {
        return $this->belongsTo(Program::class);
    }

    public function resultados()
    {
        return $this->hasMany(LearningOutcome::class);
    }
}

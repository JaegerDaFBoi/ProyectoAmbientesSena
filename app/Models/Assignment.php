<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = "assignments";

    public function evento()
    {
        return $this->belongsTo(Event::class, 'fk_asignacion');
    }

    public function ficha()
    {
        return $this->hasOne(Card::class, 'id', 'fk_ficha');
    }

    public function competencia()
    {
        return $this->hasOne(Competence::class, 'id');
    }

    public function resultado()
    {
        return $this->hasOne(LearningOutcome::class, 'id');
    }
    
    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'id', 'fk_instructor');
    }

    public function ambiente()
    {
        return $this->hasOne(Environment::class, 'id', 'fk_ambiente');
    }
}

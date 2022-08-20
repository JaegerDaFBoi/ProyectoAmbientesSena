<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    public function competencias()
    {
        return $this->hasMany(Competence::class, 'fk_programa');
    }

}

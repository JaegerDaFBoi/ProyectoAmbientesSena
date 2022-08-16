<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'id');
    }

    public function programa()
    {
        return $this->hasOne(Program::class, 'id');
    }
}

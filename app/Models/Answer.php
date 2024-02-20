<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'idResponden',
        "questionAnswers",
        'totalPoin'
    ];

    public function Responden(){
        return $this->belongsTo(User::class, 'idResponden');
    }

    public function User(){
        return $this->belongsTo(User::class, 'idUser');
    }
}

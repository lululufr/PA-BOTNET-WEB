<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VictimAttacks extends Model
{
    use HasFactory;

    protected $table = 'victim_attacks';
    protected $fillable = [
        'victim_id', 'type', 'state', 'text', 'result', 'created_at', 'updated_at'
    ];
}

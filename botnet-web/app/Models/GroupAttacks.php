<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAttacks extends Model
{
    use HasFactory;

    protected $table = 'group_attacks';
    protected $fillable = ['group_id', 'victim_id', 'attack_id'];

    public function group()
    {
        return $this->belongsTo(VictimGroup::class, 'group_id');
    }
}

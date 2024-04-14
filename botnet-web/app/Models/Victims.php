<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victims extends Model
{
    use HasFactory;

    public function victimGroups()
    {
        return $this->hasMany(VictimGroup::class, 'victim_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddNetwork extends Model
{
    protected $table = 'groupe';
    use HasFactory;
    protected $fillable = ['name', 'image'];
}

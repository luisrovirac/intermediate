<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HairColor extends Model
{
    use HasFactory;

	protected $fillable = ['hair_color'];

	protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    use HasFactory;

	protected $fillable = ['default_seed','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

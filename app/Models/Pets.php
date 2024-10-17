<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    use HasFactory;

	protected $fillable = ['pet'];

	protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspectRatio extends Model
{
    use HasFactory;

	protected $fillable = ['aspect_ratio','width','height'];

	protected $hidden = ['created_at', 'updated_at'];
}

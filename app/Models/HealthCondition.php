<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCondition extends Model
{
    use HasFactory;

	protected $fillable = ['health_condition'];

	protected $hidden = ['created_at', 'updated_at'];
}

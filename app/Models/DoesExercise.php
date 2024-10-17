<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoesExercise extends Model
{
    use HasFactory;

	protected $fillable = ['does_exercise'];

	protected $hidden = ['created_at', 'updated_at'];
}

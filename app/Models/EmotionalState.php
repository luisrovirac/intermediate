<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmotionalState extends Model
{
    use HasFactory;

	protected $fillable = ['emotional_state'];

	protected $hidden = ['created_at', 'updated_at'];
}

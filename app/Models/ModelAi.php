<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAi extends Model
{
    use HasFactory;

	protected $fillable = ['model_ai','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegativePrompt extends Model
{
    use HasFactory;

	protected $fillable = ['default_negative_prompt','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

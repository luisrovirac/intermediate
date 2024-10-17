<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voicex extends Model
{
    use HasFactory;

	protected $fillable = ['voicex'];

	protected $hidden = ['created_at', 'updated_at'];}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedUsed extends Model
{
    use HasFactory;

	protected $fillable = ['seedused'];

	protected $hidden = ['created_at', 'updated_at'];
}

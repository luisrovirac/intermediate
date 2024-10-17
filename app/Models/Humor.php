<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Humor extends Model
{
    use HasFactory;

	protected $fillable = ['humor'];

	protected $hidden = ['created_at', 'updated_at'];
}

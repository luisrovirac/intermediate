<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smoker extends Model
{
    use HasFactory;

	protected $fillable = ['smoker'];

	protected $hidden = ['created_at', 'updated_at'];
}

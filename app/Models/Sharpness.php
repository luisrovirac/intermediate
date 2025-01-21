<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sharpness extends Model
{
    use HasFactory;

	protected $fillable = ['sharpness','description'];

	protected $hidden = ['created_at', 'updated_at'];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

	protected $fillable = ['interest'];

	protected $hidden = ['created_at', 'updated_at'];
}

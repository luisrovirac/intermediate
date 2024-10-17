<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

	protected $fillable = ['children'];

	protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugUse extends Model
{
    use HasFactory;

	protected $fillable = ['drog_use'];

	protected $hidden = ['created_at', 'updated_at'];
}

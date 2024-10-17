<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhisicalActivity extends Model
{
    use HasFactory;

	protected $fillable = ['phisical_activity'];

	protected $hidden = ['created_at', 'updated_at'];
}

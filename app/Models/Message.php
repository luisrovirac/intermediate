<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

	protected $fillable = ['message'];

	protected $hidden = ['created_at', 'updated_at'];

}

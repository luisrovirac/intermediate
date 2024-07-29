<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class msgnotused extends Model
{
    use HasFactory;

	protected $fillable = ['stringId', 'noUsedMessages'];

	protected $hidden = ['created_at', 'updated_at'];
	
}

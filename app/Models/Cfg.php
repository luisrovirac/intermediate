<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cfg extends Model
{
    use HasFactory;

	protected $fillable = ['min','max','default','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveExtension extends Model
{
    use HasFactory;

	protected $fillable = ['save_extension','default'];

	protected $hidden = ['created_at', 'updated_at'];
}

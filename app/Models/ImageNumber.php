<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageNumber extends Model
{
    use HasFactory;

	protected $fillable = ['default_image_numbers','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

	protected $fillable = ['style','url_img_style','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

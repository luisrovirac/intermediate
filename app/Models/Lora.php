<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lora extends Model
{
    use HasFactory;

	protected $fillable = ['lora','url_img_lora', 'infoLoraIni', 'infoLoraEnd','description'];

	protected $hidden = ['created_at', 'updated_at'];
}

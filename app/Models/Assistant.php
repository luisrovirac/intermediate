<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'details','infoLoraIni','infoLoraEnd','typesex_id','voice','photo01','photo02','photo03','photo04','photo05'];

	protected $hidden = ['created_at', 'updated_at'];
}

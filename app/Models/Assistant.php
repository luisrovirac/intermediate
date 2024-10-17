<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

	protected $fillable = ['typesex_id','name','infoLoraIni','infoLoraEnd','voice', 'details','photo01','photo02','photo03','photo04','photo05','seed','typeSeed_o_Lora','prompt','userIdCreator'];

	protected $hidden = ['created_at', 'updated_at'];
}

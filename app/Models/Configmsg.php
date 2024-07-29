<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configmsg extends Model
{
    use HasFactory;

	protected $fillable = ['arraymessage', 'forporcentaje', 'waittimeinseconds', 'minNumberRandom', 'maxNumberRandom'];

	protected $hidden = ['created_at', 'updated_at'];

}

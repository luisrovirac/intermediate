<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationStatus extends Model
{
    use HasFactory;

	protected $fillable = ['relation_status'];

	protected $hidden = ['created_at', 'updated_at'];
}

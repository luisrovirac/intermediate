<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyOrientation extends Model
{
    use HasFactory;

	protected $fillable = ['family_orientation'];

	protected $hidden = ['created_at', 'updated_at'];
}

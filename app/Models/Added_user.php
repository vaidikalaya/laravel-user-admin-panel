<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Added_user extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['user_id','added_by'];
}

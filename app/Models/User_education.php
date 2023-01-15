<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_education extends Model
{
    use HasFactory;
    protected $fillable=['type','specialty','institute','start_date','end_date','user_id'];
}

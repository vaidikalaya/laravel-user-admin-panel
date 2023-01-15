<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_experience extends Model
{
    use HasFactory;
    protected $fillable=['organization','location','designation','start_date','end_date','user_id'];
}

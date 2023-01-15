<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_research_paper extends Model
{
    use HasFactory;
    protected $fillable=['title', 'url', 'user_id'];
}

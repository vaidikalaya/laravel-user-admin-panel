<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_tag_relation extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable=['blog_id','tag_id'];
}

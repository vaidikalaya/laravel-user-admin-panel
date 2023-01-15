<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable=['title','slug','content','other','category_id','author_id'];

    public function category(){
        return $this->belongsTo(Blog_category::class,'category_id');
    }

    public function tags(){
        return $this->hasManyThrough(Blog_tag::class,Blog_tag_relation::class,'blog_id','id','id','tag_id');
    }
}

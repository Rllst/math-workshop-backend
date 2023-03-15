<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    use HasFactory;
    protected $fillable = ['name','description'];
    protected $table = 'categories';
    public function posts(){
        $this->belongsToMany(Post::class, 'post_category');
    }
}

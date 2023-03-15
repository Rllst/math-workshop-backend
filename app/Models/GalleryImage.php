<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends BaseModel
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'gallery_images';
}

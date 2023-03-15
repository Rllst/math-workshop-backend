<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryFolder extends BaseModel
{
    use HasFactory;
    protected $fillable = ['name', 'date', 'description'];
    protected $table = 'gallery_folders';

    public function images(){
        return $this->hasMany(GalleryImage::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveFolder extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $table= 'archive_folders';

    public function files(){
        return $this->hasMany(ArchiveFile::class);
    }
}

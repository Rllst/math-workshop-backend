<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveFile extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'date'];

    protected $table = 'archive_files';
}

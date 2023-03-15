<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends BaseModel
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'date'];
    protected $table = 'documents';
}

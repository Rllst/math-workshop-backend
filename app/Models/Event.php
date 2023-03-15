<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends BaseModel
{
    use HasFactory;
    protected $fillable = ['date', 'description', 'name'];
    protected $table = 'events';
}

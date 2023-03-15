<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends BaseModel
{
    use HasFactory;

    protected $fillable = ['author', 'content'];
    protected $table = 'quotes';

}

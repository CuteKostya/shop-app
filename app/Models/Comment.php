<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable
        = [
            'id',
            'product_id',
            'user_id',
            'description',
            'grade',
        ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{


    protected $fillable
        = [
            'id',
            'product_id',
            'user_id',
            'count',
        ];
}

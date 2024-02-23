<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{


    protected $fillable
        = [
            'id',
            'products_id',
            'users_id',
            'count',
        ];
}

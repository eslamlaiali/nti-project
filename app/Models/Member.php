<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'member_id'); // One member has many products
    }
}

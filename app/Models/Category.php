<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany('App\Models\Products');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }
}

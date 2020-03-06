<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany("App\Product","category_product","category_id","product_id");
    }

    public function getProducts()
    {
       return $this->products()->where('category_id',$this->id)->where('active','!=','0')->paginate(9);
    }

}

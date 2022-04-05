<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function childrenRecursive()
    {
      return $this->children()->with('childrenRecursive');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function AttributeGroups()
    {
       return $this->belongsToMany(AttributeGroup::class,'attributegroup_category','category_id','attributegroup_id');
    }
}

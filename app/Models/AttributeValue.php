<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table="attributes_value";

    public function attributeGroup()
    {
       return $this->belongsTo(AttributeGroup::class,'attributegroup_id');
    }
}

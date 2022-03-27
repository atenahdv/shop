<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;
    protected $table='attributes_group';

    public function attributesValue()
    {
       return $this->hasMany(AttributeValue::class);
    }
}

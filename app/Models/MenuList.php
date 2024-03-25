<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuList extends Model
{
    use HasFactory;

    protected $fillable = [
        "menu",
        "price",
        "picture",
        "energy",
        "protein",
        "lipid",
        "carbohydrates",
        "salt",
        "calcium",
        "vegetable",
        "halal",
    ];
}

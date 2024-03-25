<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuViewer extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'show_date',
        'sold_out',
    ];
}

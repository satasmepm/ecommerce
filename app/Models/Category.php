<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [

    'categoryname',
    'description',
    'status',
    'image',
    'created_at',
    'updated_at'

     ];
    use HasFactory;
}

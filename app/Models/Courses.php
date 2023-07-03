<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vehicle;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type','status','time','rate','vat','total'
    ];


}

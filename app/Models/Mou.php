<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parties_involved',
        'effective_date',
        'description',
        'status',
    ];
}
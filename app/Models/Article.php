<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Autoriser ces champs à être remplis via create() ou update()
    protected $fillable = ['title', 'excerpt', 'content'];
}

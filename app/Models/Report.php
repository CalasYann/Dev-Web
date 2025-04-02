<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Report extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // Vérifie bien que la clé étrangère est correcte
}

}
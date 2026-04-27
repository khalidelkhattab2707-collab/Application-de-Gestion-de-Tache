<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Une catégorie a plusieurs tâches
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
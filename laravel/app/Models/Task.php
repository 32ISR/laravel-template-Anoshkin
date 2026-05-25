<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'category_id',
        'user_id'
    ];
    public function tasks()
    {
        return $this->hasMany
        (Category::class);
    }

    public function user()
    {
        return $this->belongsTo
        (User::class);
    }
    
}

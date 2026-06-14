<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'activity_date',
        'image',
        'priority',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

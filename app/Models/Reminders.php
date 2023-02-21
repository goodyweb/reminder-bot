<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'description',
        'webhook',
        'footer',
        'image'
    ];
}

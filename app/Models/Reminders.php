<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    use HasFactory;

    protected $table = 'reminders';
    public $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'description',
        'webhook',
        'footer',
        'image'
    ];
}

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
        'user_id',
        'content',
        'description',
        'webhook',
        'type',
        'type2',
        'footer',
        'dateend',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

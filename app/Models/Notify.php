<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;

    
    protected $table = 'notifies';
    public $primaryKey = 'id';
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

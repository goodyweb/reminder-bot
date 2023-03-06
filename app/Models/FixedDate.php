<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedDate extends Model
{
    use HasFactory;

    protected $table = 'fixeddate';
    public $primaryKey = 'id';
   
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

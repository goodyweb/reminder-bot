<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnfixedDate extends Model
{
    use HasFactory;

    protected $table = 'unfixeddate';
    public $primaryKey = 'id';
<<<<<<< HEAD
    protected $fillable = [
        'details' ,
        'webhook' ,
        'month',
        'week' ,
        'day',
        'frequency'
   ];
=======
   
>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

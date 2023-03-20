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
   
>>>>>>> cc37251 (finished adding functions for unfixed date on ReminderController adding kernel and adding commands)
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

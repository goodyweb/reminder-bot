<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixeddate extends Model
{
    use HasFactory;

    protected $table = 'fixeddates';
    protected $fillable = [
        'details' ,
        'webhook' ,
        'startMonth',
        'startDay' ,
        'endMonth',
        'endDay',
        'year',
        'frequency'
    ];
    public $primaryKey = 'id';
   
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

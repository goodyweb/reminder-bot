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
        'startendmonth',
        'startDay' ,
        'endendmonth',
        'endDay',
        'year',
        'frequency'
    ];
    public $primaryKey = 'id';

    public function getendmonth()
   {
       $endmonth = $this->attributes['endMonth'];
        if($endmonth == 1)
            return "Jan.";
        else if($endmonth == 2)
            return "Feb.";
        else if($endmonth == 3)
            return "Mar.";
        else if($endmonth == 4)
            return "Apr.";
        else if($endmonth == 5)
            return "May";
        else if($endmonth == 6)
            return "Jun.";
        else if($endmonth == 7)
            return "Jul.";
        else if($endmonth == 8)
            return "Aug.";
        else if($endmonth == 9)
            return "Sep.";
        else if($endmonth == 10)
            return "Oct.";
        else if($endmonth == 11)
            return "Nov.";
        else if($endmonth == 12)
            return "Dec.";
        else return "";
    }
   
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

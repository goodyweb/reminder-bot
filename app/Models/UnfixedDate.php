<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unfixeddate extends Model
{
    use HasFactory;

    protected $table = 'unfixeddates';
    public $primaryKey = 'id';
    protected $fillable = [
        'details' ,
        'webhook' ,
        'month',
        'week' ,
        'day',
        'frequency'
   ];
  
   public function getmonth()
   {
       $month = $this->attributes['month'];
        if($month == 1)
            return "January";
        else if($month == 2)
            return "February";
        else if($month == 3)
            return "March";
        else if($month == 4)
            return "April";
        else if($month == 5)
            return "May";
        else if($month == 6)
            return "June";
        else if($month == 7)
            return "July";
        else if($month == 8)
            return "August";
        else if($month == 9)
            return "September";
        else if($month == 10)
            return "October";
        else if($month == 11)
            return "November";
        else if($month == 12)
            return "December";
        else return "";
    }

    public function getweek(){
        $week = $this->attributes['week'];
        if($week == 1)
        return "1st week";
        else if($week == 2)
        return "2nd week";
        else if($week == 3)
        return "3rd week";
        else if($week == 4)
        return "4th week";
        else if($week == 5)
        return "5th week";
        else return "";
    }
    public function getday(){
        $day = $this->attributes['day'];
        if($day == 0)
        return "Sunday";
        else if($day == 1)
        return "Monday";
        else if($day == 2)
        return "Tuesday";
        else if($day == 3)
        return "wednesday";
        else if($day == 4)
        return "Thursday";
        else if($day == 5)
        return "Friday";
        else if($day == 6)
        return "Saturday";

    }
   
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

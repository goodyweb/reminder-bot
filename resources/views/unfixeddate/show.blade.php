@extends('templates.master')
<<<<<<< HEAD
@section('content')

<style type="text/css">
   /* general styling */
   :root {
  --smaller: .75;
}

=======



@section('content')
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Poppins fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

      

<style type="text/css">
   /* general styling */
   :root {
  --smaller: .75;
}

<<<<<<< HEAD
>>>>>>> c89504f (rebase)
=======
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  height: 100%;
  margin: 0;
}

body {
  align-items: center;
<<<<<<< HEAD
<<<<<<< HEAD
  background-color: lightgray;
=======
  background-color: #ffd54f;
>>>>>>> c89504f (rebase)
=======
  background-color: #ffd54f;
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)
  font-family: -apple-system, 
    BlinkMacSystemFont, 
    "Segoe UI", 
    Roboto, 
    Oxygen-Sans, 
    Ubuntu, 
    Cantarell, 
    "Helvetica Neue", 
    sans-serif;
}

.container1 {
<<<<<<< HEAD
<<<<<<< HEAD
=======
  color: #333;
>>>>>>> c89504f (rebase)
=======
  color: #333;
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)
  margin: 0 auto;
  text-align: center;
}

h1 {
  font-weight: normal;
  letter-spacing: .125rem;
  text-transform: uppercase;
}

li {
  display: inline-block;
  font-size: 1.5em;
  list-style-type: none;
<<<<<<< HEAD
<<<<<<< HEAD
=======
  padding: 1em;
  text-transform: uppercase;
>>>>>>> c89504f (rebase)
=======
  padding: 1em;
  text-transform: uppercase;
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)
}

li span {
  display: block;
<<<<<<< HEAD
<<<<<<< HEAD
  padding: .5em;
=======
>>>>>>> c89504f (rebase)
=======
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)
  font-size: 4.5rem;
}

.emoji {
  display: none;
  padding: 1rem;
}

.emoji span {
  font-size: 4rem;
  padding: 0 .5rem;
}

@media all and (max-width: 768px) {
  h1 {
    font-size: calc(1.5rem * var(--smaller));
  }
  
  li {
    font-size: calc(1.125rem * var(--smaller));
  }
  
  li span {
    font-size: calc(3.375rem * var(--smaller));
  }
}

</style>

</head>
<script>
    <?php 
   
   if($results->month == 1){
       $month = "January";
   }elseif($results->month == 2){
       $month = "February";
   }elseif($results->month == 3){
       $month = "March";
   }elseif($results->month == 4){
       $month = "April";
   }elseif($results->month == 5){
       $month = "May";
   }elseif($results->month == 6){
       $month = "June";
   }elseif($results->month == 7){
       $month = "July";
   }elseif($results->month == 8){
       $month = "August";
   }elseif($results->month == 9){
       $month = "September";
   }elseif($results->month == 10){
       $month = "October";
   }elseif($results->month == 11){
       $month = "November";
   }elseif($results->month == 12){
       $month = "December";
   }

   if($results->week == 0){
       $week = "First";
   }elseif($results->week == 1){
       $week = "Second";
   }elseif($results->week == 2){
       $week = "Third";
   }elseif($results->week == 3){
       $week = "Fourth";
   }elseif($results->week == 4){
       $week = "Fifth";
   }

   if($results->day == 0){
       $day = "Sunday";
   }elseif($results->day == 1){
       $day = "Monday";
   }elseif($results->day == 2){
       $day = "Tuesday";
   }elseif($results->day == 3){
       $day = "Wednesday";
   }elseif($results->day == 4){
       $day = "Thursday";
   }elseif($results->day == 5){
       $day = "Friday";
   }elseif($results->day == 6){
       $day = "Saturday";
   }


       
       $year = $results->year;

       $timestamp = strtotime("$week $day of $month $year");

       $dateString = date("Y-m-d", $timestamp);
        ?>
        var countDownDate = new Date("<?php echo "$dateString"; ?>").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            var now = new Date().getTime();
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="counter"11
            

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
  
          
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("headline").innerText = "Times Up!";
            document.getElementById("countdown").style.display = "none";
            document.getElementById("content").style.display = "block";
            }
        }, 1000);
<<<<<<< HEAD
<<<<<<< HEAD
    </script>    
=======
    </script>

    
>>>>>>> c89504f (rebase)
=======
    </script>

    
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<<<<<<< HEAD
<<<<<<< HEAD
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="border-radius: 15px 50px 5px">
=======
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
>>>>>>> c89504f (rebase)
=======
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
>>>>>>> 8159690 (Updating show blade , adding algo for countdown)
                <div class="p-6 text-gray-900">

                <center><h1>Countdown</h1></center>
                    <br><center>
                      <b>Ends @ </b><br>
                    <?php $date=date_create($dateString);
                        echo date_format($date, "d F Y H:i:s"); 
                    ?>
                   </center>
                    <div class="container1">
                       
                            <h1 id="headline">{{$results->details}}</h1>
                            <div id="countdown">
                                <ul>
                                    
                                <li><span id="days"></span>Days</li>
                                
                                <li><span id="hours"></span>Hours</li>
                                <li><span id="minutes"></span>Minutes</li>
                                <li><span id="seconds"></span>Seconds</li>
                                </ul>
                            </div>
                            <div id="content" class="emoji">
                            
                                <span>The</span>
                                <span>Countdown</span>
                                <span>Ends </span>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
   
@endsection
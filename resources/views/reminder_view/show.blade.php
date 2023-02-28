@extends('templates.master')


@section('content')

<style type="text/css">
   /* general styling */
   :root {
  --smaller: .75;
}

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
  background-color: #ffd54f;
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
  color: #333;
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
  padding: 1em;
  text-transform: uppercase;
}

li span {
  display: block;
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


<script>

 (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  //this is for countdown view
  
  let today = new Date(),
      t = {!! json_encode($results->dateend) !!}.split(/[- :]/),
      endDate = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0),
      dd = String(today.getDate()).padStart(2, "0"),
      mm = String(today.getMonth() + 1).padStart(2, "0"),
      yyyy = today.getFullYear(),
      nextYear = endDate.getFullYear(),
      dd1 = String(endDate.getDate()).padStart(2, "0"),
      mm1 = String(endDate.getMonth() + 1).padStart(2, "0"),
      birthday = mm1 + "/" + dd1 + "/" + yyyy;
  today = mm + "/" + dd + "/" + yyyy;
  if (today > birthday) {
    birthday = dayMonth + nextYear;
  }
  //end
  
  const countDown = new Date(birthday).getTime(),
      x = setInterval(function() {    

        const now = new Date().getTime(),
              distance = countDown - now;
              distance1 = Math.floor((distance % (minute)) / second);

        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance1 <= 0.000001) {
          document.getElementById("headline").innerText = "Times Up!";
          document.getElementById("countdown").style.display = "none";
          document.getElementById("content").style.display = "block";
          clearInterval(x);
        }
        //seconds
      }, 0)
  }());
    </script>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <center><h1>" {{$results->content}} " countdown</h1></center>
                    <br><center>
                      <b>Ends @ </b><br>
                    <?php $date=date_create($results->dateend);
                        echo date_format($date, "d F Y H:i:s"); 
                    ?>
                   </center>
                    <div class="container1">
                       
                            <h1 id="headline">Countdown to my {{$results->content}}</h1>
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
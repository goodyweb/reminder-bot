@extends('templates.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">ALL REMINDERS</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('reminders.create')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
                <i data-feather="plus"></i> Add New Reminders
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @if ($message = session('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                    <tr>
                        <th class="pt-0">#</th>
                        <th class="pt-0">Reminder Title</th>
                        <th class="pt-0">Content Detail</th>
                        <th class="pt-0">Description</th>
                        <th class="pt-0">Webhook Link</th>
                        <th class="pt-0">Footer</th>
                        <th class="pt-0">Date End</th>
                        <th class="pt-0">Rerminder Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reminders as $index => $val)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$val->title}}</td>
                            <td>{{$val->content}}</td>
                            <td>{{$val->description}}</td>
                            <td>{{$val->webhook}}</td>
                            <td>{{$val->footer}}</td>
                            <?php $date=date_create($val->dateend); ?>
                            <td>
                            <div id="countdown">
                                
                                    
                                    <p><span id="days"></span>Days</p>
                                    
                                    <p><span id="hours"></span>Hours</p>
                                    <p><span id="minutes"></span>Minutes</p>
                                    <p><span id="seconds"></span>Seconds</p>
                                
                            </div></td>

                            <td><img alt="img" src="/img/{{ $val->image }}" class="text-center" width="100px" height="100px"></td>
                            <td>
                                <form action="{{ route('reminders.destroy',$val->id) }}" method="POST">
                                    {{ csrf_field()  }}
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-success" href="{{route('reminders.show', $val->id)}}"><i data-feather="eye"></i> Show</a>
                                    <a class="btn btn-sm btn-warning" href="{{route('reminders.edit', $val->id)}}"><i data-feather="link"></i> Edit</a>
                                    <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
<script>

 (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  //this is for countdown view
  
  let today = new Date(),
      t = {!! json_encode($val->dateend) !!}.split(/[- :]/),
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

        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
          document.getElementById("headline").innerText = "Times Up!";
          document.getElementById("countdown").style.display = "none";
          document.getElementById("content").style.display = "block";
          clearInterval(x);
        }
        //seconds
      }, 0)
  }());
    </script>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

    
@endsection
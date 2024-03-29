<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: black;
  border-radius: 15px 50px 5px; 
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 12px 14px;
  font-size: 15px;
  width: 20%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: black;
  display: none;
  padding: 15px 20px;
  height: auto;
  border-radius: 15px 50px;
}

#Home {background-color: #F9B904;}
#News {background-color: #F9B904;}
</style>
@extends('templates.master')
@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{route('fixeddate.create')}}" class="btn btn-warning btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px 30px 5px" >
          <i data-feather="plus"></i> Add New Reminders
        </a>
    </div>
</div>

  <button class="tablink" onclick="openPage('Home', this, '#ffc729')" id="defaultOpen">Card View</button>
  <button class="tablink" onclick="openPage('News', this, '#ffc729')">Table View</button> 
    <div>
        <h2 class="mb-3 mb-md-0 text-center text-color: yellow background-color: #F9B904;"><b>ALL REMINDERS</b></h2>
        <hr>
      </div>

<div id="Home" class="tabcontent">
<div class="container">
        @if(count($fixeddate) > 0)
          <div class="row">
              @foreach ($fixeddate as $index => $val)
              <div class="col-xl-4 mt-4 mb-4 mb-xl-0">
                  <div class="card shadow">
                      <img class="card-img-top card-img-top-post" src="/img/{{ $val->image }}">
                      <div class="card-body card-body-post">
                        <h3 class="card-title">{{ $val->title }}</h3>
                        <p class="card-text card-text-post">
                          {{$val->content}}
                        </p>
                        <p><small>Written by {{ $val->details }} | {{ $val->updated_at }}</small></p>
                      
                        <hr>
                        <div class="button-group row">
                          <div class="col-8">
                            <a href="{{route('reminder_view.show', $val->id)}}" class="btn btn-outline-primary btn-sm"><i data-feather="eye"></i>View</a>            
                            <a href="{{route('reminders.edit', $val->id)}}" class="btn btn-outline-info btn-sm"><i data-feather="link"></i>Edit</a>
                          </div>
                            <div class="col-4 text-right">
                                <form action="{{ route('fixeddate.destroy',$val->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirm('Are you sure you want to dissolve the {{ $val->details }} class?') ? this.parentElement.submit() : ''"><i data-feather="trash"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
        @else
          <div class="row mt-9 mb-9">
            <div class="col text-center">
                <p class="lead">No Reminders Found</p>
                <br>
                <a href="" class="btn btn-primary btn-lg">Create Reminder</a>
            </div>
          </div>
        @endif
    </div>
</div>

<div id="News" class="tabcontent">
    <div class="card" style="border-radius: 15px 50px 5px">
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
<<<<<<< HEAD
                        <th class="pt-0">Reminder Details</th>
                        <th class="pt-0">Webhook</th>
                        <th class="pt-0">Types Notifications</th>
                        <th class="pt-0">Start Date(Month)</th>
                        <th class="pt-0">Start Date(Day)</th>
                        <th class="pt-0">End Date(Month)</th>
                        <th class="pt-0">End Date(Day)</th>
                        <th class="pt-0">Image</th>
                        <th class="text-center">Actions</th>
=======
                        <th class="pt-0">Reminder Title</th>
                        <th class="pt-0">Content Detail</th>
                        <th class="pt-0">Description</th>
                        <th class="pt-0">Date End</th>
                        <th class="pt-0">Image <?php echo Carbon\Carbon::now()->dayOfWeek ?></th>
                        <th class="text-center">Actions </th>
<<<<<<< HEAD
>>>>>>> dcc7459 (adding and updating unfixed function on reminderController)
=======
>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fixeddate as $index => $val)
                        <tr>
                            <td>{{++$index}}
                           
                            </td>
                            <td>{{$val->title }} </td>
                            <td>{{$val->content}}</td>
                            <td>{{$val->description}} <?php echo  Carbon\Carbon::now()->weekOfMonth?></td>
                            @if($val->dateend <= Carbon\Carbon::now()->setTimezone('Asia/Manila'))
                            
                              <?php 
                                    $date = new DateTime($val->dateend);
                                    $date1 = date_format($date, "F d, Y H:i:s");?>
                                <td>Ended on <?php echo $date1; ?></td>
                            @else
                            <?php 
                                    $setDate = Carbon\Carbon::now()->setTimezone('Asia/Manila')->diff(Carbon\Carbon::parse($val->dateend)->setTimezone('Asia/Manila'));
                                ?>
                                <?php $dateTime=Carbon\Carbon::now()->setTimezone('Asia/Manila'); ?>
                                
                                <td>
                                @if($val->type == "Weeks")
                                <?php echo $setDate->days ." days " . $setDate->h . " hours " . $setDate->i . " minutes " . $setDate->s . " seconds"; ?>
                                @elseif($val->type == "Days")
                                <?php echo $setDate->days ." days " . $setDate->h . " hours " . $setDate->i . " minutes " . $setDate->s . " seconds"; ?>
                                @elseif($val->type == "Just Days")
                                <?php echo $setDate->days ." days "; ?>
                                @endif
                                </td>
                           @endif
                            <td><img alt="img" src="/img/{{ $val->image }}" class="text-center" width="100px" height="100px"></td>
                            <td>
                                <form action="{{ route('reminders.destroy',$val->id) }}" method="POST">
                                    {{ csrf_field()  }}
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-success" href="{{route('reminder_view.show', $val->id)}}"><i data-feather="eye"></i> Show</a>
                                    <a class="btn btn-sm btn-warning" href="{{route('reminders.edit', $val->id)}}"><i data-feather="link"></i> Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirm('Are you sure you want to dissolve the {{ $val->title }} class?') ? this.parentElement.submit() : ''"><i data-feather="trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
</div>

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>   
@endsection
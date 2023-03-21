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

#Home {background-color: #FFD20A;}
#News {background-color: #FFD20A;}
</style>
@extends('templates.master')
@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{route('fixeddates.create')}}" class="btn btn-dark btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px 30px 5px" >
          <i data-feather="plus"></i> Add New Reminders
        </a>
    </div>
</div>

  <button class="tablink" onclick="openPage('Home', this, '#FFD20A')" id="defaultOpen">Card View</button>
  <button class="tablink" onclick="openPage('News', this, '#FFD20A')">Table View</button> 
    <div>
        <h2 class="mb-3 mb-md-0 text-center text-color: yellow background-color: #FFD20A;"><b>ALL REMINDERS</b></h2>
        <hr>
      </div>

<div id="Home" class="tabcontent">
<div class="container">
        @if(count($fixeddate) > 0)
          <div class="row">
              @foreach ($fixeddate as $index => $val)
              <div class="col-xl-4 mt-4 mb-4 mb-xl-0">
                  <div class="card shadow" style="border-radius: 15px 50px 5px">
                      <!--<img class="card-img-top card-img-top-post" src="/img/{{ $val->image }}">-->
                      <div class="card-body card-body-post"><hr>
                        <h2 class="card-title"><b>{{ $val->details }}</b></h2>             
                        <p><small>Written by Goody Web | {{ $val->updated_at }}</small></p>
                      
                        <hr>
                        <div class="button-group row">
                          <div class="col-8">
                            <a href="{{route('reminder_view.show', $val->id)}}" class="btn btn-info btn-sm"><i data-feather="eye"></i>View</a>            
                            <a href="{{route('fixeddates.edit', $val->id)}}" class="btn btn-warning btn-sm"><i data-feather="link"></i>Edit</a>
                          </div>
                            <div class="col-4 text-right">
                                <form action="{{ route('fixeddates.destroy',$val->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirm('Are you sure you want to dissolve the {{ $val->details }} class?') ? this.parentElement.submit() : ''"><i data-feather="trash"></i> Delete</button>
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
                <a href="{{route('fixeddates.create')}}" class="btn btn-dark btn-icon-text mb-2 mb-md-0">Create Reminder</a>
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
                        <th class="pt-0">Reminder Details</th>
                        <!--<th class="pt-0">Webhook Link</th>-->
                        <th class="pt-0">Type Notifications</th>
                        <th class="pt-0">Start Date</th>
                        <th class="pt-0">End Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fixeddate as $index => $val)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$val->details}}</td>
                            <!-- <td>{{$val->webhook}}</td>-->
                            <td>{{$val->frequency}}</td>
                            <td>{{$val->startMonth}}/{{$val->startDay}}/<?php echo date("Y"); ?></td>
                            <td>{{$val->endMonth}}/{{$val->endDay}}/{{$val->year}}</td>
                            <td>
                                <form action="{{ route('fixeddates.destroy',$val->id) }}" method="POST">
                                    {{ csrf_field()  }}
                                    @method('DELETE')
                                    <a class="btn btn-info" href="{{route('reminder_view.show', $val->id)}}"><i data-feather="eye"></i> Show</a>
                                    <a class="btn btn-warning" href="{{route('fixeddates.edit', $val->id)}}"><i data-feather="link"></i> Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirm('Are you sure you want to dissolve the {{ $val->details }} reminder?') ? this.parentElement.submit() : ''"><i data-feather="trash"></i> Delete</button>
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
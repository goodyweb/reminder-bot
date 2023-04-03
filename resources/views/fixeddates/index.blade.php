@extends('templates.master')
@section('content')
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: black;
  color: white;
  border-radius: 5px;
  float: right;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 5px 5px;
  font-size: 14px;
  width: 10%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  border-radius: 5px;
  color: black;
  border-style: solid;
  border-color: lightgray;
  border-width: 1px;
  display: none;
  padding: 5px 5px;
  height: auto;
}

@media all and (max-width: 1000px) {
  .tablink {
    padding: 2px 2px;
    font-size: 10px;
    width: 15%;
  }
}

#Home {background-color: light;}
#News {background-color: light;}
</style>


<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{route('fixeddates.create')}}" class="btn btn-dark btn-icon-text mb-0 mb-md-0 text-warning" >
          <i data-feather="plus"></i> Add New Reminders
        </a>
    </div>
  @if ($message = session('success'))
    <div class="col col-lg-4">
        <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
          <i class="bi-check-circle-fill"></i>
            <strong class="mx-2">Success!</strong> {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div> 
    </div>
  @endif

  @if(count($fixeddate) > 0 || $search != null)
    <div class="col col-lg-3">
          <form action="/fixeddates?" method="get" class="search-form" >
              <div class="input-group input-group-sm pt-0">
                    <input name="search" class="form-control" placeholder="Search here..." type="text" >
                    <div class="input-group-prepend">
                      <button class="btn btn-dark" type="submit"><i data-feather="search"></i></button>
                  </div>
              </div>
          </form>
      </div>
  @endif
</div>
  <button class="tablink" onclick="openPage('News', this, '#FFD20A')">Table View</button> 
  <button class="tablink" onclick="openPage('Home', this, '#FFD20A')" id="defaultOpen">Card View</button>

    <div class="container">
      <div class="container">
        <h2 class="mb-1 mb-md-1 text-left text-color: yellow background-color: #FFD20A;"><b>ALL REMINDERS</b></h2>
      </div>
    </div>

<div id="Home" class="tabcontent">
<div class="container">
        @if(count($fixeddate) > 0)
          <div class="row">
              @foreach ($fixeddate as $index => $val)
              <div class="col-xl-4 mt-3 mb-2 mb-xl-0">
                  <div class="card shadow" >
                      <!--<img class="card-img-top card-img-top-post" src="/img/{{ $val->image }}">-->
                      <div class="card-body card-body-post"><hr>
                        <h2 class="card-title"><b>{{ $val->details }}</b></h2>   
                        <h6 class="text-muted">Due: <strong>{{$val->getendmonth()}} {{$val->endDay}}, {{ $val->year }}</strong> </h6>          
                        <p><small>Written by {{$val->user->name}} | {{ $val->updated_at }}</small></p><hr>

                        <div class="button-group row">
                          <div class="col-8">
                            <a href="{{route('fixeddates.show', $val->id)}}" class="btn btn-outline-info btn-sm"><i data-feather="eye"></i>View</a>            
                            <a href="{{route('fixeddates.edit', $val->id)}}" class="btn btn-outline-warning btn-sm"><i data-feather="link"></i>Edit</a>
                          </div>
                            <div class="col-4 text-right">
                                <form action="{{ route('fixeddates.destroy',$val->id) }}" method="POST">
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
                <a href="{{route('fixeddates.create')}}" class="btn btn-dark btn-icon-text mb-2 mb-md-0">Create Reminder</a>
            </div>
          </div>
        @endif
    </div>
</div>

<div id="News" class="tabcontent">
    <div class="card">
        <div class="card-body">
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
                            <td class="text-center">
                                <form action="{{ route('fixeddates.destroy',$val->id) }}" method="POST">
                                    {{ csrf_field()  }}
                                    @method('DELETE')
                                    <a class="btn btn-outline-info" href="{{route('fixeddates.show', $val->id)}}"><i data-feather="eye"></i> Show</a>
                                    <a class="btn btn-outline-warning" href="{{route('fixeddates.edit', $val->id)}}"><i data-feather="link"></i> Edit</a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirm('Are you sure you want to dissolve the {{ $val->details }} reminder?') ? this.parentElement.submit() : ''"><i data-feather="trash"></i> Delete</button>
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
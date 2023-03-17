@extends('templates.master')

@section('content')

<div class="card" style="border-radius: 15px 50px 30px; background-color: #FFD20A">
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted" >ADD NEW REMINDER</h4> 
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('fixeddate.index')}}" class="btn btn-light btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px">
                All Reminders
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="mt-2 alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="card shadow-lg p-3 mb-3 mb-md-0" style="border-radius: 15px 50px 30px">
            <div class="card-body">
                <form action="{{ route('fixeddate.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="pl-lg-4 row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="mb-3">
                            <label for="details" class="form-label"><b>Reminder details</b><span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Details" name="details" id="details" cols="12" rows="2"></textarea>
                            <div id="editor" style="font-family: 'Open Sans', sans-serif"></div>
                        </div>

                        <div class="mb-3">
                            <label for="webhook" class="form-label"><b>Webhook</b><span class="text-danger">*</span></label>
                            <input id="webhook" name="webhook" type="text" class="form-control" placeholder="Webhook Link">
                        </div>
                    </div>
                        <div class="pl-lg-4 row">
                            <h5 class="heading-small text-muted mb-4 mt-3"><b><hr>Start date</b></h5>
                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="startMonth">Month</label>
                                    <select id="startMonth" name="startMonth" class="form-select" required>
                                        <option value="">-- Select month --</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="startDay">Day</label>
                                        <select id="startDay" name="startDay" class="form-select" required>
                                            <option value="">-- Select day --</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="frequency" class="form-label"><b>Notify me? : </b><span class="text-danger">*</span></label>
                                        <select name="frequency" id="frequency" class="form-select">
                                            <option value="">-- Please select --</option>
                                            <option value="Monthly"> Monthly</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Hourly">Hourly</option>
                                            <option value="Minutes">Minutes</option>
                                        </select>
                                    </div>

                                    <div class="mb-3"><br>
                                        <label for="image" class="form-label"><b>Reminder image</b><span class="text-muted">(optional)</span></label>
                                        <input id="image" name="image" type="file" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="heading-small text-muted mb-4 mt-3"><b><hr>End date</b></h5>
                                    <div class="col-12 col-md-6">
                                        <label class="form-control-label" for="endMonth">Month</label>
                                        <select id="endMonth" name="endMonth" class="form-select" required>
                                            <option value="">-- Select month --</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-control-label" for="endDay">Day</label>
                                        <select class="form-select" id="e   ndDay" name="endDay" required>
                                            <option value="">-- Select day --</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="mb-3"><br>
                                <button type="submit" class="btn btn-primary btn-icon-text mb-2 mb-md-0">Save Reminder Data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!--<div class="card mb-3 mb-md-0">
        <div class="card-body">

            @if ($errors->any())
                <div class="mt-2 alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reminders.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="mb-3">
                    <label for="title" class="form-label">Reminder Details <span class="text-danger">*</span></label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Title Name">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Month<span class="text-danger">*</span></label>
                    <input id="content" name="content" type="text" class="form-control" placeholder="Content Detail">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Day<span class="text-danger">*</span></label>
                    <textarea class="form-control" placeholder="Description" name="description" id="description" cols="12" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="webhook" class="form-label">Webhook<span class="text-danger">*</span></label>
                    <input id="webhook" name="webhook" type="text" class="form-control" placeholder="Webhook Link">
                </div>
                <div class="mb-3">
                    <label for="footer" class="form-label">Footer<span class="text-danger">*</span></label>
                    <input id="footer" name="footer" type="text" class="form-control" placeholder="Footer">
                </div>

                <div class="mb-3">
                    <label for="dateend" class="form-label">End Date and Time: <span class="text-danger">*</span></label>
                    <input class="form-control mb-4"type ="datetime-local" id="dateend" name="dateend" value="2018-07-22" min="2018-01-01" max="2030-12-31">
                </div>

            <div class="form-row">
            <div class="col">
                        <label for="type2">Type <span class="text-danger">*</span></label>
                            <select name="type2" id="type2" class="form-control mb-4" required>
                                    <option value="reminders"> Multiple Reminder</option>
                                    <option value="countdown">Countdown</option>
                                </select>
                        </div>
            <div class="mb-3" hidden>
                        <label for="format" class="col-form-label">1Format</label>
                            <select name="format" id="countdown" class="form-control mb-4" required>
                                    <option selected disabled value="">Select ...</option>
                                    <option value="Weeks"> Months / Days / Hours / Minutes / Seconds</option>
                                    <option value="Days">Days / Hours / Minutes / Seconds</option>
                                    <option value="Just Days">Just Days</option>
                                </select>
                        </div>
                        </div>

                      <div class="form-control mb-4">
                        <label for="notif" class="form-label">Notify Me?: <span class="text-danger">*</span></label>
                        <select name="notif" id="notif" class="form-control mb-4">
                                    <option value="monthly"> Monthly</option>
                                    <option value="daily">Daily</option>
                                    <option value="hourly">Hourly</option>
                                    <option value="minutes">Minutes</option>
                                </select>
                      </div>
            
                <div class="mb-3">
                    <label for="image" class="form-label">Reminder Image <span class="text-danger">*</span></label>
                    <input id="image" name="image" type="file" class="form-control">
                </div>
                
                <div>
                    <button type="submit" class="btn btn-success btn-icon-text mb-2 mb-md-0">
                        Save Reminder Data
                    </button>
                </div>


            </form>
        </div>

    </div>-->
@endsection

@push('js')
<script src="{{ asset('vendor/quilljs-1.3.6/quill.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      let intervalFunc = function () {
          let image_path = $('#cover_image').val().split('\\');
          $('#browse-image').html(image_path[image_path.length - 1]);
      };

      $('#cover_image').on('click', function () {
          setInterval(intervalFunc, 1);
      });

      let quill = new Quill('#editor', {
        modules: {
          toolbar: [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'align': [] }]
          ]
        },
        theme: 'snow'
      });

      $("#btn-publish").click(function(){
          let body = $("#editor *").html();

          $("input#body").val(body);
      });
  });
</script>
@endpush
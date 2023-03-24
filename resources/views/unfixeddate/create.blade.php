@extends('templates.master')

@section('content')

<div class="card" style="border-radius: 15px 50px 30px; background-color: #FFD20A">
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted" >ADD NEW REMINDER</h4> 
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('unfixeddate.index')}}" class="btn btn-light btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px">
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
                <form action="{{ route('unfixeddate.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="pl-lg-4 row">
                    <div class="col-12 col-md-7">
                        <div class="row">
                            <div class="">
                            <label for="details" class="form-label"><b>Reminder details</b><span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Details" name="details" id="details" cols="12" rows="2"></textarea>
                            <div id="editor" style="font-family: 'Open Sans', sans-serif"></div>
                        </div>
                    </div>

                        <div class="pl-lg-6 row">
                            <h5 class="heading-small text-muted mb-4 mt-3"><b>Date</b></h5>
                            <div class="col-12 col-md-5">
                                <label class="form-control-label" for="month">Month</label>
                                <select id="month" name="month" class="form-select" required>
                                    <option value="">-- //--</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-control-label" for="week">Week</label>
                                <select class="form-select" id="week" name="week" required>
                                    <option value="">-- // --</option>
                                    <option value="01">1st Week</option>
                                    <option value="02">2nd Week</option>
                                    <option value="03">3rd Week</option>
                                    <option value="04">4rth Week</option>
                                    <option value="05">4rth Week</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-3">
                                <label class="form-control-label" for="day">Week</label>
                                <select class="form-select" id="day" name="day" required>
                                    <option value="">-- / --</option>
                                    <option value="01">Monday</option>
                                    <option value="02">Tuesday</option>
                                    <option value="03">Wednesday</option>
                                    <option value="04">Thursday</option>
                                    <option value="05">Friday</option>
                                    <option value="06">Saturday</option>
                                    <option value="0">Sunday</option>
                                </select>
                            </div>
                        </div>
                        </div>
                            <div class="col-12 col-md-5">
                                <div class="row">
                                    <div class="mb-5">
                                        <label for="webhook" class="form-label"><b>Webhook</b><span class="text-danger">*</span></label>
                                        <textarea id="webhook" name="webhook" type="text" class="form-control" placeholder="Webhook Link" cols="12" rows="2"></textarea>
                                    </div>
                                    <div class="mb-3 md-6">
                                        <label for="frequency" class="form-label"><b>Frequency : </b><span class="text-danger">*</span></label>
                                        <select name="frequency" id="frequency" class="form-select">
                                            <option value="">-- Please select --</option>
                                            <option value="Monthly"> Monthly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="SemiAnnually">SemiAnnually</option>
                                            <option value="Annually">Annually</option>
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
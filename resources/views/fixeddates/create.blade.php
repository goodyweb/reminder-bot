@extends('templates.master')

@section('content')

<div class="card">
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted" >ADD NEW REMINDER</h4> 
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('fixeddates.index')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
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

        <div class="card mb-3 mb-md-0" style="border-radius: 15px">
            <div class="card-body">
                <form action="{{ route('fixeddates.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="frequency" class="form-label"><b>Frequency : </b><span class="text-danger">*</span></label>
                                <select name="frequency" id="frequency" class="form-select">
                                    <option value="" hidden>-- Please select --</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Quarterly">Quarterly</option>
                                    <option value="SemiAnnually">Semi-Annually</option>
                                    <option value="Annually">Annually</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="row">
                            <h5 class="heading-small text-muted mb-4 mt-3"><b>Start date</b></h5>
                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="startMonth">Month</label>
                                    <select id="startMonth" name="startMonth" class="form-select" required>
                                        <option value="" hidden>-- // --</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-2">
                                    <label class="form-control-label" for="startDay">Day</label>
                                        <select id="startDay" name="startDay" class="form-select" required>
                                            <option value="" hidden>-/-</option>
                                            <option value='01'>01</option>
                                            <option value='02'>02</option>
                                            <option value='03'>03</option>
                                            <option value='04'>04</option>
                                            <option value='05'>05</option>
                                            <option value='06'>06</option>
                                            <option value='07'>07</option>
                                            <option value='08'>08</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='24'>24</option>
                                            <option value='25'>25</option>
                                            <option value='26'>26</option>
                                            <option value='27'>27</option>
                                            <option value='28'>28</option>
                                            <option value='29'>29</option>
                                            <option value='30'>30</option>
                                            <option value='31'>31</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-control-label" for="Year">Year</label>
                                        <input class="form-control" value="<?php echo date("Y"); ?>" id="year" name="year" disabled><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5 class="heading-small text-muted mb-4 mt-3"><b>End date</b></h5>
                                    <div class="col-12 col-md-6">
                                        <label class="form-control-label" for="endMonth">Month</label>
                                        <select id="endMonth" name="endMonth" class="form-select" required>
                                            <option value="" hidden>-- // --</option>
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

                                    <div class="col-12 col-md-2">
                                        <label class="form-control-label" for="endDay">Day</label>
                                        <select class="form-select" id="endDay" name="endDay" required>
                                            <option value="" hidden>-/-</option>
                                            <option value='01'>01</option>
                                            <option value='02'>02</option>
                                            <option value='03'>03</option>
                                            <option value='04'>04</option>
                                            <option value='05'>05</option>
                                            <option value='06'>06</option>
                                            <option value='07'>07</option>
                                            <option value='08'>08</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='24'>24</option>
                                            <option value='25'>25</option>
                                            <option value='26'>26</option>
                                            <option value='27'>27</option>
                                            <option value='28'>28</option>
                                            <option value='29'>29</option>
                                            <option value='30'>30</option>
                                            <option value='31'>31</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-control-label" for="endYear">Year</label>
                                        <select class="form-select" id="year" name="year" required>
                                            <option value="" hidden>-/-</option>
                                            <option value='2023'>2023</option>
                                            <option value='2024'>2024</option>
                                            <option value='2025'>2025</option>
                                            <option value='2026'>2026</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class=""><br>
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
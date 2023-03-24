@extends('templates.master')

@section('content')
<div class="card" style="border-radius: 15px 50px 30px; background-color: #FFD20A">
        <div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted">EDIT REMINDERS</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap" >
            <a href="{{route('unfixeddate.index')}}" class="btn btn-light btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px ">
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

<div class="card mb-3 mb-md-0 " style="border-radius: 15px 50px 30px">
    <div class="card-body">          
            <form action="{{ route('unfixeddate.update', $unfixeddate->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="pl-lg-4 row">
                    <div class="col-12 col-md-7">
                        <div class="row">
                            <div class="">
                            <label for="details" class="form-label"><b>Reminder Details</b><span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Details" name="details" id="details" cols="12" rows="2">{{$unfixeddate->details}}</textarea>
                            <div id="editor" style="font-family: 'Open Sans', sans-serif"></div>
                        </div>
                    </div>
                        <div class="pl-lg-4 row">
                            <h5 class="heading-small text-muted mb-4 mt-3"><b>Date</b></h5>
                                <div class="col-12 col-md-5">
                                    <label class="form-control-label" for="month">Month</label>
                                    <select id="month" name="month" class="form-select" required>
                                        <option value="{{ old('month') == null ? 'selected' : '' }}">-- // --</option>
                                        <option value="01" {{ old('month', $unfixeddate->month) == '01' ? 'selected' : 'selected' }}>January</option>
                                        <option value="02" {{ old('month', $unfixeddate->month) == '02' ? 'selected' : '' }}>February</option>
                                        <option value="03" {{ old('month', $unfixeddate->month) == '03' ? 'selected' : '' }}>March</option>
                                        <option value="04" {{ old('month', $unfixeddate->month) == '04' ? 'selected' : '' }}>April</option>
                                        <option value="05" {{ old('month', $unfixeddate->month) == '05' ? 'selected' : '' }}>May</option>
                                        <option value="06" {{ old('month', $unfixeddate->month) == '06' ? 'selected' : '' }}>June</option>
                                        <option value="07" {{ old('month', $unfixeddate->month) == '07' ? 'selected' : '' }}>July</option>
                                        <option value="08" {{ old('month', $unfixeddate->month) == '08' ? 'selected' : '' }}>August</option>
                                        <option value="09" {{ old('month', $unfixeddate->month) == '09' ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ old('month', $unfixeddate->month) == '10' ? 'selected' : '' }}>October</option>
                                        <option value="11" {{ old('month', $unfixeddate->month) == '11' ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ old('month', $unfixeddate->month) == '12' ? 'selected' : '' }}>December</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-control-label" for="week">Week</label>
                                        <select id="week" name="week" class="form-select" required>
                                            <option value="{{ old('week') == null ? 'selected' : '' }}">-- // --</option>
                                            <option value="01" {{ old('week', $unfixeddate->week) == '01' ? 'selected' : '' }}>Week 1</option>
                                            <option value="02" {{ old('week', $unfixeddate->week) == '02' ? 'selected' : '' }}>Week 2</option>
                                            <option value="03" {{ old('week', $unfixeddate->week) == '03' ? 'selected' : '' }}>Week 3</option>
                                            <option value="04" {{ old('week', $unfixeddate->week) == '04' ? 'selected' : '' }}>Week 4</option>
                                            <option value="05" {{ old('week', $unfixeddate->week) == '05' ? 'selected' : '' }}>Week 5</option>                         
                                    </select>
                                </div>

                                <div class="col-12 col-md-3">
                                <label class="form-control-label" for="day">Week</label>
                                    <select class="form-select" id="day" name="day" required>
                                        <option value="">-- / --</option>
                                        <option value="01" {{ old('day', $unfixeddate->day) == '01' ? 'selected' : '' }}>Monday</option>
                                        <option value="02" {{ old('day', $unfixeddate->day) == '02' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="03" {{ old('day', $unfixeddate->day) == '03' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="04" {{ old('day', $unfixeddate->day) == '04' ? 'selected' : '' }}>Thursday</option>
                                        <option value="05" {{ old('day', $unfixeddate->day) == '05' ? 'selected' : '' }}>Friday</option>
                                        <option value="06" {{ old('day', $unfixeddate->day) == '06' ? 'selected' : '' }}>Saturday</option>
                                        <option value="0" {{ old('day', $unfixeddate->day) == '0' ? 'selected' : '' }}>Sunday</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                            <div class="col-12 col-md-5">
                                <div class="row">
                                    <div class="mb-5">
                                        <label for="webhook" class="form-label"><b>Webhook</b><span class="text-danger">*</span></label>
                                        <textarea id="webhook" name="webhook" type="text" class="form-control" placeholder="Webhook Link" cols="12" rows="2">{{$unfixeddate->webhook}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="frequency" class="form-label"><b>Frequency : </b><span class="text-danger">*</span></label>
                                        <select name="frequency" id="frequency" class="form-select">
                                            <option value="Monthly" {{ old('frequency', $unfixeddate->frequency) == 'Monthly' ? 'selected' : '' }}> Monthly</option>
                                            <option value="Quarterly" {{ old('frequency', $unfixeddate->frequency) == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                            <option value="SemIAnnually" {{ old('frequency', $unfixeddate->frequency) == 'SemiAnnually' ? 'selected' : '' }}>SemiAnnually</option>
                                            <option value="Annually" {{ old('frequency', $unfixeddate->frequency) == 'Annually' ? 'selected' : '' }}>Annually</option>
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
<script>
        $(document).ready(function () {
            $("#image").hide();
            $("#hide").attr('disabled', true);
            $("#hide").click(function () {
                $("#image").hide();
                $("#hide").attr('disabled', true);
                $("#show").attr('disabled', false);
  
            });
            $("#show").click(function () {
                $("#image").show();
                $("#hide").attr('disabled', false);
                $("#show").attr('disabled', true);
            });
        });
    </script>
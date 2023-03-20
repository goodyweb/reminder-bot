@extends('templates.master')

@section('content')
<div class="card" style="border-radius: 15px 50px 30px; background-color: #FFD20A">
        <div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted">EDIT REMINDERS</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap" >
            <a href="{{route('fixeddate.index')}}" class="btn btn-light btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px ">
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
            <form action="{{ route('fixeddate.update', $fixeddate->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="pl-lg-4 row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="mb-3">
                            <label for="details" class="form-label"><b>Reminder Details</b><span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Details" name="details" id="details" cols="12" rows="2">{{$fixeddate->details}}</textarea>
                            <div id="editor" style="font-family: 'Open Sans', sans-serif"></div>
                        </div>

                        <div class="mb-3">
                            <label for="webhook" class="form-label"><b>Webhook</b><span class="text-danger">*</span></label>
                            <input value="{{$fixeddate->webhook}}" id="webhook" name="webhook" type="text" class="form-control" placeholder="Webhook Link">
                        </div>
                    </div>
                        <div class="pl-lg-4 row">
                            <h5 class="heading-small text-muted mb-4 mt-3"><b><hr>Start Date</b></h5>
                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="startMonth">Month</label>
                                    <select id="startMonth" name="startMonth" class="form-select" required>
                                        <option value="{{ old('startMonth') == null ? 'selected' : '' }}">-- Select Month --</option>
                                        <option value="January" {{ old('startMonth', $fixeddate->startMonth) == 'January' ? 'selected' : 'selected' }}>January</option>
                                        <option value="February" {{ old('startMonth', $fixeddate->startMonth) == 'February' ? 'selected' : '' }}>February</option>
                                        <option value="March" {{ old('startMonth', $fixeddate->startMonth) == 'March' ? 'selected' : '' }}>March</option>
                                        <option value="April" {{ old('startMonth', $fixeddate->startMonth) == 'April' ? 'selected' : '' }}>April</option>
                                        <option value="May" {{ old('startMonth', $fixeddate->startMonth) == 'May' ? 'selected' : '' }}>May</option>
                                        <option value="June" {{ old('startMonth', $fixeddate->startMonth) == 'June' ? 'selected' : '' }}>June</option>
                                        <option value="July" {{ old('startMonth', $fixeddate->startMonth) == 'July' ? 'selected' : '' }}>July</option>
                                        <option value="August" {{ old('startMonth', $fixeddate->startMonth) == 'August' ? 'selected' : '' }}>August</option>
                                        <option value="September" {{ old('startMonth', $fixeddate->startMonth) == 'September' ? 'selected' : '' }}>September</option>
                                        <option value="October" {{ old('startMonth', $fixeddate->startMonth) == 'October' ? 'selected' : '' }}>October</option>
                                        <option value="November" {{ old('startMonth', $fixeddate->startMonth) == 'November' ? 'selected' : '' }}>November</option>
                                        <option value="December" {{ old('startMonth', $fixeddate->startMonth) == 'December' ? 'selected' : '' }}>December</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="startDay">Day</label>
                                        <select id="startDay" name="startDay" class="form-select" required>
                                            <option value="{{ old('startDay') == null ? 'selected' : '' }}">-- Select Day --</option>
                                            <option value="Monday" {{ old('startDay', $fixeddate->startDay) == 'Monday' ? 'selected' : '' }}>Monday</option>
                                            <option value="Tuesday" {{ old('startDay', $fixeddate->startDay) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                            <option value="Wednesday" {{ old('startDay', $fixeddate->startDay) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                            <option value="Thursday" {{ old('startDay', $fixeddate->startDay) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                            <option value="Friday" {{ old('startDay', $fixeddate->startDay) == 'Friday' ? 'selected' : '' }}>Friday</option>
                                            <option value="Saturday" {{ old('startDay', $fixeddate->startDay) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                            <option value="Sunday" {{ old('startDay', $fixeddate->startDay) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="frequency" class="form-label"><b>Notify Me? : </b><span class="text-danger">*</span></label>
                                        <select name="frequency" id="frequency" class="form-select">
                                            <option value="Monthly" {{ old('frequency', $fixeddate->frequency) == 'Monthly' ? 'selected' : '' }}> Monthly</option>
                                            <option value="Daily" {{ old('frequency', $fixeddate->frequency) == 'Daily' ? 'selected' : '' }}>Daily</option>
                                            <option value="Hourly" {{ old('frequency', $fixeddate->frequency) == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                                            <option value="Minutes" {{ old('frequency', $fixeddate->frequency) == 'Minutes' ? 'selected' : '' }}>Minutes</option>
                                        </select>
                                    </div>

                                    <div class="mb-3"><br>
                                        <label for="image" class="form-label"><b>Reminder Image</b><span class="text-muted">(optional)</span></label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <img id="image" class="mt-2" src="/img/{{ $fixeddate->image }}" width="50px" hidden>
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="heading-small text-muted mb-4 mt-3"><b><hr>End Date</b></h5>
                                    <div class="col-12 col-md-6">
                                        <label class="form-control-label" for="endMonth">Month</label>
                                        <select id="endMonth" name="endMonth" class="form-select" required>
                                        <option value="{{ old('endMonth') == null ? 'selected' : '' }}">-- Select Month --</option>
                                        <option value="January" {{ old('endMonth', $fixeddate->endMonth) == 'January' ? 'selected' : '' }}>January</option>
                                        <option value="February" {{ old('endMonth', $fixeddate->endMonth) == 'February' ? 'selected' : '' }}>February</option>
                                        <option value="March" {{ old('endMonth', $fixeddate->endMonth) == 'March' ? 'selected' : '' }}>March</option>
                                        <option value="April" {{ old('endMonth', $fixeddate->endMonth) == 'April' ? 'selected' : '' }}>April</option>
                                        <option value="May" {{ old('endMonth', $fixeddate->endMonth) == 'May' ? 'selected' : '' }}>May</option>
                                        <option value="June" {{ old('endMonth', $fixeddate->endMonth) == 'June' ? 'selected' : '' }}>June</option>
                                        <option value="July" {{ old('endMonth', $fixeddate->endMonth) == 'July' ? 'selected' : '' }}>July</option>
                                        <option value="August" {{ old('endMonth', $fixeddate->endMonth) == 'August' ? 'selected' : '' }}>August</option>
                                        <option value="September" {{ old('endMonth', $fixeddate->endMonth) == 'September' ? 'selected' : '' }}>September</option>
                                        <option value="October" {{ old('endMonth', $fixeddate->endMonth) == 'October' ? 'selected' : '' }}>October</option>
                                        <option value="November" {{ old('endMonth', $fixeddate->endMonth) == 'November' ? 'selected' : '' }}>November</option>
                                        <option value="December" {{ old('endMonth', $fixeddate->endMonth) == 'December' ? 'selected' : '' }}>December</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-control-label" for="endDay">Day</label>
                                        <select class="form-select" id="endDay" name="endDay" required>
                                            <option value="{{ old('startDay') == null ? 'selected' : '' }}">-- Select Day --</option>
                                            <option value="Monday" {{ old('endDay', $fixeddate->endDay) == 'Monday' ? 'selected' : '' }}>Monday</option>
                                            <option value="Tuesday" {{ old('endDay', $fixeddate->endDay) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                            <option value="Wednesday" {{ old('endDay', $fixeddate->endDay) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                            <option value="Thursday" {{ old('endDay', $fixeddate->endDay) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                            <option value="Friday" {{ old('endDay', $fixeddate->endDay) == 'Friday' ? 'selected' : '' }}>Friday</option>
                                            <option value="Saturday" {{ old('endDay', $fixeddate->endDay) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                            <option value="Sunday" {{ old('endDay', $fixeddate->endDay) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
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
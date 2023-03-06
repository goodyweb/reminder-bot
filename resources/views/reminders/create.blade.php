@extends('templates.master')

@section('content')
<div class="card" style="border-radius: 15px 50px 30px">
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted" >ADD NEW REMINDER</h4> 
            <select name="frequency" id="frequency" class="form-select">
                <option value="">-- Select Format --</option>
                <option value="monthly">Fixed Date</option>
                <option value="daily">Unfixed Date</option>
            </select>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('reminders.index')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px 30px">
                All Reminders
            </a>
        </div>
    </div>

<div class="card bg-warning mb-3 mb-md-0 " style="border-radius: 15px 50px 30px">
        <div class="card-body">
    <div class="card shadow-lg p-3 mb-3 mb-md-0" style="border-radius: 15px 50px 30px">
    <h3 class="heading-small text-primary mb-4 mt-3" style="text-align: center"><b>[ REMINDER EVENT ]</b></h3><hr>
        <div class="card-body">
            <div class="pl-lg-4 row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="mb-3">
                        <label for="details" class="form-label"><b>Reminder Details</b><span class="text-danger">*</span></label>
                        <textarea class="form-control" placeholder="Details" name="details" id="details" cols="12" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="webhook" class="form-label"><b>Webhook</b><span class="text-danger">*</span></label>
                        <input id="webhook" name="webhook" type="text" class="form-control" placeholder="Webhook Link">
                    </div>
                </div>
                    <div class="pl-lg-4 row">
                        <h6 class="heading-small text-muted mb-4 mt-3">Start Date</h6>
                            <div class="col-12 col-md-6">
                                <label class="form-control-label" for="startMonth">Month</label>
                                <select id="startMonth" name="startMonth" class="form-select" required>
                                    <option value="">-- Select Month --</option>
                                    <option value="1">Janaury</option>
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

                            <div class="col-12 col-md-6">
                                <label class="form-control-label" for="startDay">Day</label>
                                    <select id="startDay" name="startDay" class="form-select" required>
                                        <option value="">-- Select Day --</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                        <option value="7">Sunday</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="frequency" class="form-label"><b>Notify Me? : </b><span class="text-danger">*</span></label>
                                    <select name="frequency" id="frequency" class="form-select">
                                        <option value="monthly"> Monthly</option>
                                        <option value="daily">Daily</option>
                                        <option value="hourly">Hourly</option>
                                        <option value="minutes">Minutes</option>
                                    </select>
                                </div>

                                <div class="mb-3"><br>
                                    <label for="image" class="form-label"><b>Reminder Image</b><span class="text-muted">(optional)</span></label>
                                    <input id="image" name="image" type="file" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <h6 class="heading-small text-muted mb-4 mt-3">End Date</h6>
                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="endMonth">Month</label>
                                    <select id="endMonth" name="endMonth" class="form-select" required>
                                        <option value="">-- Select month --</option>
                                        <option value="1">Janaury</option>
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

                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="endDay">Day</label>
                                    <select class="form-select" id="endDay" name="endDay" required>
                                        <option value="">-- Select day --</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                        <option value="7">Sunday</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"><br>
                        <button type="submit" class="btn btn-success btn-icon-text mb-2 mb-md-0" style="border-radius: 15px 50px 30px 5px">Save Reminder Data</button>
                    </div>
                </div>
            </div>
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
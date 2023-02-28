@extends('templates.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Add New Reminder</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('reminders.index')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
                All Reminders
            </a>
        </div>
    </div>

    <div class="card mb-3 mb-md-0">
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

            <div class="mb-3">
                        <label for="type2">Type <span class="text-danger">*</span></label>
                            <select name="type2" id="type2" class="form-control mb-4">
                                    <option value="reminders"> Multiple Reminder</option>
                                    <option value="countdown">Countdown</option>
                                </select>
                        </div>
            <div class="mb-3">
                        <label for="type">Format <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control mb-4">
                                    <option value="Weeks"> Months / Days / Hours / Minutes / Seconds</option>
                                    <option value="Days">Days / Hours / Minutes / Seconds</option>
                                    <option value="Just Days">Just Days</option>
                                </select>
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

    </div>
@endsection
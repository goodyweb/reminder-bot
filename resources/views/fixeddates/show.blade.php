@extends('templates.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">All Reminder</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('reminders.index')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
                All Reminders
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Reminder Title</label>
                    <input value="{{$reminder->title}}" disabled id="title" name="title" type="text" class="form-control" placeholder="Reminder Title">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Reminder Content</label>
                    <input value="{{$reminder->content}}" disabled id="content" name="content" type="text" class="form-control" placeholder="Reminder Content">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Reminder Description</label>
                    <textarea class="form-control" disabled placeholder="Reminder Description" name="description" id="description" cols="12" rows="3">{{$reminder->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="webhook" class="form-label">Reminder Webhook</label>
                    <input value="{{$reminder->webhook}}" disabled id="webhook" name="webhook" type="text" class="form-control" placeholder="Reminder Webhook"> 
                </div>
                <div class="mb-3">
                    <label for="footer" class="form-label">Reminder Footer</label>
                    <input value="{{$reminder->footer}}" disabled id="footer" name="footer" type="text" class="form-control" placeholder="Reminder Footer">
                </div>

                <div class="form-control mb-4">
                    <label for="year" class="form-label">End Date and Time: <span class="text-danger">*</span></label>
                    <input class="form-control mb-4" value="{{$reminder->year}}" type ="datetime-local" disabled id="year" name="year" min="2018-01-01" max="2030-12-31">
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Reminder Image Data</label>
                    <div>
                        <img class="mt-2" src="/img/{{ $reminder->image }}" width="300px">
                    </div>
                </div>

                <div>
                    <a href="{{route('reminders.edit',$reminder->id)}}" class="btn btn-success btn-icon-text mb-2 mb-md-0">
                        Edit Reminder
                    </a>
                </div>

            </form>
        </div>

        
    </div>
@endsection
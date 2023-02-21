@extends('templates.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Edit Reminders</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('products.index')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
                All REMINDERS
            </a>
        </div>
    </div>

    <div class="card">
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

            <form action="{{ route('reminders.update', $reminder->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Reminder Title <span class="text-danger">*</span></label>
                    <input value="{{$reminder->title}}" id="title" name="title" type="text" class="form-control" placeholder="Reminder Title">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Reminder Content<span class="text-danger">*</span></label>
                    <input value="{{$reminder->content}}" id="content" name="content" type="text" class="form-control" placeholder="Reminder Content">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Reminder Description<span class="text-danger">*</span></label>
                    <textarea class="form-control" placeholder="Detail Reminder Title" name="description" id="description" cols="12" rows="3">{{$reminder->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="webhook" class="form-label">Reminder Webhook<span class="text-danger">*</span></label>
                    <input value="{{$reminder->webhook}}" id="webhook" name="webhook" type="webhook" class="form-control" placeholder="Reminder Webhook">
                </div>
                <div class="mb-3">
                    <label for="footer" class="form-label">Reminder Footer<span class="text-danger">*</span></label>
                    <input value="{{$reminder->footer}}" id="footer" name="footer" type="footer" class="form-control" placeholder="Reminder Footer">
                </div>

                <div class="mb-3">
                    <label for="dateend" class="form-label">End Date and Time: <span class="text-danger">*</span></label>
                    <input value="{{$reminder->dateend}}" type ="datetime-local" id="dateend" name="dateend" value="2018-07-22" min="2018-01-01" max="2030-12-31">
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Reminder Image Data <span class="text-danger">*</span></label>
                    <input id="image" name="image" type="file" class="form-control">
                    <img class="mt-2" src="/img/{{ $reminder->image }}" width="500px">
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
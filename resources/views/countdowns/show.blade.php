@extends('templates.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">All Countdown</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="javascript:void(0)" id="createNewCountdown" class="btn btn-info btn-icon-text mb-2 mb-md-0">
                <i data-feather="plus"></i> Add New Countdowns
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0 data-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Countdown Title</th>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-lg" id="countdownmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form id="countdownForm" name="countdownForm" method="POST" enctype="multipart/form-data">
                        <div id="error"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Countdown Title </label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="Countdown Title">
                        </div>
                        <div class="mb-3">
                            <label for="event" class="form-label">Events</span>
                            <input id="event" name="event" type="text" class="form-control" placeholder="Event Details">
                        </div>
                        
                        <div class="form-control mb-4">
                            <label for="date" class="form-label">Date: <span class="text-danger">*</span></label>
                            <input class="form-control mb-3" type="date" id="date" name="date" value="2018-07-22" min="2018-01-01" max="2030-12-31">
                        </div>

                        <div class="form-control mb-4">
                            <label for="time">Countdown Time <span class="text-danger">*</span></label>
                            <input class="form-control mb-3" type="time" id="time" name="time" min="09:00" max="18:00" required>
                        </div>
                         
                        <div class="mb-3">
                        <label for="type">Format <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control mb-4">
                                    <option value="Weeks"> Weeks / Days / Hours / Minutes / Seconds</option>
                                    <option value="Days">Days / Hours / Minutes / Seconds</option>
                                    <option value="Just Days">Just Days</option>
                                </select>
                            </select>
                        </div>

                        <div>
                            <button id="savedata" name="savedata" type="button" class="btn btn-success btn-icon-text mb-2 mb-md-0">
                                Save Countdown Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('user-script')
    <script type="text/javascript">
        $(document).ready(function($){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }


            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                select: true,
                info: false,
                paging: false,
                filter:false,
                ajax: "{{ url('countdowns/show') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class:'text-center'},
                    {data: 'title', name: 'title'},
                    {data: 'event', name: 'event'},
                    {data: 'date', name: 'date'},
                    {data: 'time', name: 'time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
                ]
            });

            $('#createNewCountdown').click(function () {
                $('#savedata').html('Save Countdown Data');
                $('#id').val('');
                $('#countdownForm').trigger("reset");
                $('#modelHeading').html("Create New Countdown");
                $('#countdownmodal').modal('show');
                $('#error').html('');
            });

            $('body').on('click', '.editCountdown', function () {
                $('#savedata').html('Save Countdown Data');
                var id = $(this).data('id');

                $.ajax({
                    type:"POST",
                    url: "{{ url('countdowns/edit') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(data){
                        $('#modelHeading').html("Edit Countdown");
                        $('#countdownmodal').modal('show');
                        $('#id').val(data.id);
                        $('#title').val(data.title);
                        $('#event').val(data.event);
                        $('#date').val(data.date);
                        $('#time').val(data.time);
                        $('#error').html('');
                    }
                });

            });

            $('#savedata').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#countdownForm').serialize(),
                    url: "{{ url('countdowns/store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#countdownForm').trigger("reset");
                        $('#countdownmodal').modal('hide');
                        table.draw();
                        toastr.success('Data saved successfully','Success');

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#error').html("<div class='alert alert-danger'>"+data['responseJSON']['message'] + "</div>");
                        $('#savedata').html('Save Countdown Data');
                    }
                });
            });

            $('body').on('click', '.deleteCountdown', function () {
                var id = $(this).data("id");
                if (confirm("Are You sure want to delete this Countdownt!") === true) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('countdowns/destroy')}}",
                        data:{
                            id:id
                        },
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }

            });
        });
    </script>
@endsection

@extends('templates.master')
@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                        <div class="bg-info card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">All Reminders</h3>
                                </div>
                                
                                <div class="col text-right">
                                    
                                </div>
                               
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th></th>
                                    <th class="pt-4">#</th>
                                    <th class="pt-4">Reminders</th>
                                    <th class="pt-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>1</td>
                                        <td>Fix Reminder Dates</td>
                                        <td> <a href="{{route('fixeddates.index')}}" class="btn btn-outline-primary btn-sm"><i data-feather="eye"></i> View more details </a></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>2</td>
                                        <td>Unfix Reminder Dates</td>
                                        <td> <a href="{{route('unfixeddate.index')}}" class="btn btn-outline-primary btn-sm"><i data-feather="eye"></i> View more details </a></td>
                                    </tr>
                                    <tr><td></td></tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="card shadow">
                        <div class="bg-info card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Events</h3>
                                </div>
                                <div class="col-12 col-md-3">
                                    <a href="{{route('fixeddates.index')}}" class="btn btn-sm btn-warning align-items-right">See all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">fixeddate Title</th>
                                        <th scope="col">Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>                              
                                @foreach($unfixeddate as $index => $val)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{$val->details}}</td>
                                        <td>{{$val->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                   
                        
                    
                </div>
            </div>
        </div>

        
    </div>


@endsection
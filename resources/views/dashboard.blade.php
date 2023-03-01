@extends('templates.master')
@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                        <div class="bg-light card-header border-0">
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
                                    <th class="pt-3"></th>
                                    <th class="pt-3">#</th>
                                    <th class="pt-3">Reminder Title</th>
                                    <th class="pt-3">Content Detail</th>
                                    <th class="pt-3">Description</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($reminders as $index => $val)
                                <tr>
                                    <td></td>
                                    <td>{{++$index}}</td>
                                    <td>{{$val->title}}</td>
                                    <td>{{$val->content}}</td>
                                    <td>{{$val->description}}</td>
                                    <td> <a href="{{route('reminders.show', $val->id)}}" class="btn btn-outline-primary btn-sm">View Details </a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3 mb-5">
                            <div class="col text-center">
                                <a href="{{route('reminders.create')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">Create Reminders</a>
                            </div>
                        </div>
                </div>
            </div>

            <x-guest-layout>
            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="card shadow">
                        <div class="bg-light card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Events</h3>
                                </div>
                                <div class="col align-items-right">
                                    <a href="{{route('reminders.index')}}" class="btn btn-sm btn-warning align-items-right">See all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Reminders Title</th>
                                        <th scope="col">Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>                              
                                @foreach($reminders as $index => $val)
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{$val->title}}</td>
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

</x-guest-layout>
@endsection
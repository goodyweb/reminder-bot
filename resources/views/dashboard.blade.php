@extends('templates.master')
@section('content')
<div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col"> 
                                    <h5 class="card-title text-uppercase text-muted mb-0">Fixed Date</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $tot_fixeddate }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="link-icon" data-feather="clock"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">Overall</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Unfixed Date</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $tot_unfixeddate }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="link-icon" data-feather="clock"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">Overall</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $tot_users }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="link-icon" data-feather="user"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">Overall</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Events</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $tot_fixeddate + $tot_unfixeddate }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="link-icon" data-feather="book"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">Overall</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>          
    </div>




    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-7 mb-5 mb-xl-0">
                <div class="card shadow">
                        <div class="bg-info card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Fix Date Events</h3>
                                </div>
                                <div class="col-12 col-md-2">
                                    <a href="{{route('fixeddates.index')}}" class="btn btn-sm btn-warning align-items-right">Manage all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>fixed date Title</th>
                                        <th>Notify</th>
                                        <th>Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>                              
                                @foreach($fixeddate as $index => $val)
                                    <tr>
                                        <td></td>
                                        <td>{{++$index}}</td>
                                        <td>{{$val->details}}</td>
                                        <td>{{$val->frequency}}</td>
                                        <td>{{$val->endMonth}}/{{$val->endDay}}/{{$val->year}}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                </div>
            </div>
            
            <div class="col-xl-5 mb-5 mb-xl-0">
                <div class="card shadow">
                <div class="bg-info card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Unfix Date Events</h3>
                                </div>
                                <div class="col-12 col-md-3">
                                    <a href="{{route('unfixeddate.index')}}" class="btn btn-sm btn-warning align-items-right">Manage all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th scope="pt-4">#</th>
                                        <th scope="pt-4">Unfixed Date Title</th>
                                        <th scope="pt-4">Notify</th>
                                    </tr>
                                </thead>
                                <tbody>                              
                                @foreach($unfixeddate as $index => $val)
                                    <tr>
                                        <td></td>
                                        <td>{{++$index}}</td>
                                        <td>{{$val->details}}</td>
                                        <td>{{$val->frequency}}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>   
    </div>


@endsection
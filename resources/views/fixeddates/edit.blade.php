@extends('templates.master')

@section('content')
<div class="card">
        <div class="card-body">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0 text-muted">EDIT REMINDERS</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap" >
            <a href="{{route('fixeddates.index')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
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

<div class="card mb-3 mb-md-0" style="border-radius: 15px">
    <div class="card-body">          
            <form action="{{ route('fixeddates.update', $fixeddate->id) }}" method="POST" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="frequency" class="form-label"><b>Frequency : </b><span class="text-danger">*</span></label>
                                <select name="frequency" id="frequency" class="form-select">
                                    <option value="{{ old('endMonth') == null ? 'N/A' : '' }}" hidden> -- / --</option>
                                    <option value="Monthly" {{ old('frequency', $fixeddate->frequency) == 'Monthly' ? 'selected' : '' }}>Montly</option>
                                    <option value="Quarterly" {{ old('frequency', $fixeddate->frequency) == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                    <option value="SemiAnnually" {{ old('frequency', $fixeddate->frequency) == 'SemiAnnually' ? 'selected' : '' }}>Semi-Annually</option>
                                    <option value="Annually" {{ old('frequency', $fixeddate->frequency) == 'Annually' ? 'selected' : '' }}>Annually</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>    
                    <div class="col-md-6">
                        <div class="row">
                            <h5 class="heading-small text-muted mb-4 mt-3"><b>Start Date</b></h5>
                                <div class="col-12 col-md-6">
                                    <label class="form-control-label" for="startMonth">Month</label>
                                    <select id="startMonth" name="startMonth" class="form-select" required>
                                        <option value="{{ old('startMonth') == null ? 'selected' : '' }}" hidden>-- Select Month --</option>
                                        <option value="1" {{ old('startMonth', $fixeddate->startMonth) == '1' ? 'selected' : 'selected' }}>January</option>
                                        <option value="2" {{ old('startMonth', $fixeddate->startMonth) == '2' ? 'selected' : '' }}>February</option>
                                        <option value="3" {{ old('startMonth', $fixeddate->startMonth) == '3' ? 'selected' : '' }}>March</option>
                                        <option value="4" {{ old('startMonth', $fixeddate->startMonth) == '4' ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ old('startMonth', $fixeddate->startMonth) == '5' ? 'selected' : '' }}>May</option>
                                        <option value="6" {{ old('startMonth', $fixeddate->startMonth) == '6' ? 'selected' : '' }}>June</option>
                                        <option value="7" {{ old('startMonth', $fixeddate->startMonth) == '7' ? 'selected' : '' }}>July</option>
                                        <option value="8" {{ old('startMonth', $fixeddate->startMonth) == '8' ? 'selected' : '' }}>August</option>
                                        <option value="9" {{ old('startMonth', $fixeddate->startMonth) == '9' ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ old('startMonth', $fixeddate->startMonth) == '10' ? 'selected' : '' }}>October</option>
                                        <option value="11" {{ old('startMonth', $fixeddate->startMonth) == '11' ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ old('startMonth', $fixeddate->startMonth) == '12' ? 'selected' : '' }}>December</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-2">
                                    <label class="form-control-label" for="startDay">Day</label>
                                        <select id="startDay" name="startDay" class="form-select" required>
                                            <option value="{{ old('startDay') == null ? 'selected' : '' }}" hidden>-- / --</option>
                                            <option value="01" {{ old('startDay', $fixeddate->startDay) == '01' ? 'selected' : '' }}>01</option>
                                            <option value="02" {{ old('startDay', $fixeddate->startDay) == '02' ? 'selected' : '' }}>02</option>
                                            <option value="03" {{ old('startDay', $fixeddate->startDay) == '03' ? 'selected' : '' }}>03</option>
                                            <option value="04" {{ old('startDay', $fixeddate->startDay) == '04' ? 'selected' : '' }}>04</option>
                                            <option value="05" {{ old('startDay', $fixeddate->startDay) == '05' ? 'selected' : '' }}>05</option>
                                            <option value="06" {{ old('startDay', $fixeddate->startDay) == '06' ? 'selected' : '' }}>06</option>
                                            <option value="07" {{ old('startDay', $fixeddate->startDay) == '07' ? 'selected' : '' }}>07</option>
                                            <option value="08" {{ old('startDay', $fixeddate->startDay) == '08' ? 'selected' : '' }}>08</option>
                                            <option value="09" {{ old('startDay', $fixeddate->startDay) == '09' ? 'selected' : '' }}>09</option>
                                            <option value="10" {{ old('startDay', $fixeddate->startDay) == '10' ? 'selected' : '' }}>10</option>
                                            <option value="11" {{ old('startDay', $fixeddate->startDay) == '11' ? 'selected' : '' }}>11</option>
                                            <option value="12" {{ old('startDay', $fixeddate->startDay) == '12' ? 'selected' : '' }}>12</option>
                                            <option value="13" {{ old('startDay', $fixeddate->startDay) == '13' ? 'selected' : '' }}>13</option>
                                            <option value="14" {{ old('startDay', $fixeddate->startDay) == '14' ? 'selected' : '' }}>14</option>
                                            <option value="15" {{ old('startDay', $fixeddate->startDay) == '15' ? 'selected' : '' }}>15</option>
                                            <option value="16" {{ old('startDay', $fixeddate->startDay) == '16' ? 'selected' : '' }}>16</option>
                                            <option value="17" {{ old('startDay', $fixeddate->startDay) == '17' ? 'selected' : '' }}>17</option>
                                            <option value="18" {{ old('startDay', $fixeddate->startDay) == '18' ? 'selected' : '' }}>18</option>
                                            <option value="19" {{ old('startDay', $fixeddate->startDay) == '19' ? 'selected' : '' }}>19</option>
                                            <option value="20" {{ old('startDay', $fixeddate->startDay) == '20' ? 'selected' : '' }}>20</option>
                                            <option value='21' {{ old('startDay', $fixeddate->startDay) == '21' ? 'selected' : '' }}>21</option>
                                            <option value='22' {{ old('startDay', $fixeddate->startDay) == '22' ? 'selected' : '' }}>22</option>
                                            <option value='23' {{ old('startDay', $fixeddate->startDay) == '23' ? 'selected' : '' }}>23</option>
                                            <option value='24' {{ old('startDay', $fixeddate->startDay) == '24' ? 'selected' : '' }}>24</option>
                                            <option value='25' {{ old('startDay', $fixeddate->startDay) == '25' ? 'selected' : '' }}>25</option>
                                            <option value='26' {{ old('startDay', $fixeddate->startDay) == '26' ? 'selected' : '' }}>26</option>
                                            <option value='27' {{ old('startDay', $fixeddate->startDay) == '27' ? 'selected' : '' }}>27</option>
                                            <option value='28' {{ old('startDay', $fixeddate->startDay) == '28' ? 'selected' : '' }}>28</option>
                                            <option value='29' {{ old('startDay', $fixeddate->startDay) == '29' ? 'selected' : '' }}>29</option>
                                            <option value='30' {{ old('startDay', $fixeddate->startDay) == '30' ? 'selected' : '' }}>30</option>
                                            <option value='31' {{ old('startDay', $fixeddate->startDay) == '31' ? 'selected' : '' }}>31</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-control-label" for="Year">Year</label>
                                        <input class="form-control" value="<?php echo date("Y"); ?>" id="year" name="year" disabled><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="heading-small text-muted mb-4 mt-3"><b>End Date</b></h5>
                                    <div class="col-12 col-md-6">
                                        <label class="form-control-label" for="endMonth">Month</label>
                                        <select id="endMonth" name="endMonth" class="form-select" required>
                                            <option value="{{ old('endMonth') == null ? 'selected' : '' }}" hidden>-- Select Month --</option>
                                            <option value="1" {{ old('endMonth', $fixeddate->endMonth) == '1' ? 'selected' : 'selected' }}>January</option>
                                            <option value="2" {{ old('endMonth', $fixeddate->endMonth) == '2' ? 'selected' : '' }}>February</option>
                                            <option value="3" {{ old('endMonth', $fixeddate->endMonth) == '3' ? 'selected' : '' }}>March</option>
                                            <option value="4" {{ old('endMonth', $fixeddate->endMonth) == '4' ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ old('endMonth', $fixeddate->endMonth) == '5' ? 'selected' : '' }}>May</option>
                                            <option value="6" {{ old('endMonth', $fixeddate->endMonth) == '6' ? 'selected' : '' }}>June</option>
                                            <option value="7" {{ old('endMonth', $fixeddate->endMonth) == '7' ? 'selected' : '' }}>July</option>
                                            <option value="8" {{ old('endMonth', $fixeddate->endMonth) == '8' ? 'selected' : '' }}>August</option>
                                            <option value="9" {{ old('endMonth', $fixeddate->endMonth) == '9' ? 'selected' : '' }}>September</option>
                                            <option value="10" {{ old('endMonth', $fixeddate->endMonth) == '10' ? 'selected' : '' }}>October</option>
                                            <option value="11" {{ old('endMonth', $fixeddate->endMonth) == '11' ? 'selected' : '' }}>November</option>
                                            <option value="12" {{ old('endMonth', $fixeddate->endMonth) == '12' ? 'selected' : '' }}>December</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="form-control-label" for="endDay">Day</label>
                                        <select class="form-select" id="endDay" name="endDay" required>
                                            <option value="{{ old('endDay') == null ? 'selected' : '' }}" hidden>-- / --</option>
                                            <option value="01" {{ old('endDay', $fixeddate->endDay) == '01' ? 'selected' : '' }}>01</option>
                                            <option value="02" {{ old('endDay', $fixeddate->endDay) == '02' ? 'selected' : '' }}>02</option>
                                            <option value="03" {{ old('endDay', $fixeddate->endDay) == '03' ? 'selected' : '' }}>03</option>
                                            <option value="04" {{ old('endDay', $fixeddate->endDay) == '04' ? 'selected' : '' }}>04</option>
                                            <option value="05" {{ old('endDay', $fixeddate->endDay) == '05' ? 'selected' : '' }}>05</option>
                                            <option value="06" {{ old('endDay', $fixeddate->endDay) == '06' ? 'selected' : '' }}>06</option>
                                            <option value="07" {{ old('endDay', $fixeddate->endDay) == '07' ? 'selected' : '' }}>07</option>
                                            <option value="08" {{ old('endDay', $fixeddate->endDay) == '08' ? 'selected' : '' }}>08</option>
                                            <option value="09" {{ old('endDay', $fixeddate->endDay) == '09' ? 'selected' : '' }}>09</option>
                                            <option value="10" {{ old('endDay', $fixeddate->endDay) == '10' ? 'selected' : '' }}>10</option>
                                            <option value="11" {{ old('endDay', $fixeddate->endDay) == '11' ? 'selected' : '' }}>11</option>
                                            <option value="12" {{ old('endDay', $fixeddate->endDay) == '12' ? 'selected' : '' }}>12</option>
                                            <option value="13" {{ old('endDay', $fixeddate->endDay) == '13' ? 'selected' : '' }}>13</option>
                                            <option value="14" {{ old('endDay', $fixeddate->endDay) == '14' ? 'selected' : '' }}>14</option>
                                            <option value="15" {{ old('endDay', $fixeddate->endDay) == '15' ? 'selected' : '' }}>15</option>
                                            <option value="16" {{ old('endDay', $fixeddate->endDay) == '16' ? 'selected' : '' }}>16</option>
                                            <option value="17" {{ old('endDay', $fixeddate->endDay) == '17' ? 'selected' : '' }}>17</option>
                                            <option value="18" {{ old('endDay', $fixeddate->endDay) == '18' ? 'selected' : '' }}>18</option>
                                            <option value="19" {{ old('endDay', $fixeddate->endDay) == '19' ? 'selected' : '' }}>19</option>
                                            <option value="20" {{ old('endDay', $fixeddate->endDay) == '20' ? 'selected' : '' }}>20</option>
                                            <option value='21' {{ old('endDay', $fixeddate->endDay) == '21' ? 'selected' : '' }}>21</option>
                                            <option value='22' {{ old('endDay', $fixeddate->endDay) == '22' ? 'selected' : '' }}>22</option>
                                            <option value='23' {{ old('endDay', $fixeddate->endDay) == '23' ? 'selected' : '' }}>23</option>
                                            <option value='24' {{ old('endDay', $fixeddate->endDay) == '24' ? 'selected' : '' }}>24</option>
                                            <option value='25' {{ old('endDay', $fixeddate->endDay) == '25' ? 'selected' : '' }}>25</option>
                                            <option value='26' {{ old('endDay', $fixeddate->endDay) == '26' ? 'selected' : '' }}>26</option>
                                            <option value='27' {{ old('endDay', $fixeddate->endDay) == '27' ? 'selected' : '' }}>27</option>
                                            <option value='28' {{ old('endDay', $fixeddate->endDay) == '28' ? 'selected' : '' }}>28</option>
                                            <option value='29' {{ old('endDay', $fixeddate->endDay) == '29' ? 'selected' : '' }}>29</option>
                                            <option value='30' {{ old('endDay', $fixeddate->endDay) == '30' ? 'selected' : '' }}>30</option>
                                            <option value='31' {{ old('endDay', $fixeddate->endDay) == '31' ? 'selected' : '' }}>31</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-control-label" for="endYear">Year</label>
                                        <select class="form-select" id="year" name="year" required>
                                            <option value="{{ old('year') == null ? 'selected' : '' }}" hidden>-- / --</option>
                                            <option value='2023' {{ old('year', $fixeddate->year) == '2023' ? 'selected' : '' }}>2023</option>
                                            <option value='2024' {{ old('year', $fixeddate->year) == '2024' ? 'selected' : '' }}>2024</option>
                                            <option value='2025' {{ old('year', $fixeddate->year) == '2025' ? 'selected' : '' }}>2025</option>
                                            <option value='2026' {{ old('year', $fixeddate->year) == '2026' ? 'selected' : '' }}>2026</option>
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
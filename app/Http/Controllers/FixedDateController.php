<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Fixeddate;
use App\Models\User;
use Illuminate\Http\Request;

class FixedDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixeddate = Fixeddate::all();
        $users = User::all();
        return view('fixeddates.index', compact('fixeddate', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fixeddates.create'); 
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required',
            'webhook' => 'required',
            'startMonth'=> 'required',
            'startDay' => 'required',
            'endMonth' => 'required',
            'endDay' => 'required',
            'year' => 'required',
            'frequency' => 'required',
        ]);

        $fixeddate = new Fixeddate();
        $fixeddate->details = $request->input('details');
        $fixeddate->webhook = $request->input('webhook');
        $fixeddate->startMonth = $request->input('startMonth');
        $fixeddate->startDay = $request->input('startDay');
        $fixeddate->endMonth = $request->input('endMonth');
        $fixeddate->endDay = $request->input('endDay');
        $fixeddate->year = $request->input('year');
        $fixeddate->frequency = $request->input('frequency');
        $fixeddate->save();

        return redirect()->route('fixeddates.index')
            ->with('success','Reminder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fixeddate $fixeddate)
    {
        $carbonTime = Carbon::now()->toDateTimeString();
        $results = Fixeddate::find($id);
        return view('fixeddates.show', compact('results', 'carbonTime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fixeddate $fixeddate)
    {
        return view('fixeddates.edit', compact('fixeddate'));
    }

    public function update(Request $request, Fixeddate $fixeddate)
    {
        $request->validate([
            'details' => 'required',
            'webhook' => 'required',
            'startMonth'=> 'required',
            'startDay' => 'required',
            'endMonth' => 'required',
            'endDay' => 'required',
            'year' => 'required',
            'frequency' => 'required',
        ]);
        $input = $request->all();
        $fixeddate->update($input);
        return redirect()->route('fixeddates.index')
            ->with('success','Reminder updated successfully.');
    }

    public function destroy(Fixeddate $fixeddate)
    {
        $fixeddate->delete();
        return redirect()->route('fixeddates.index')
            ->with('success','Reminder deleted successfully');
    }
}

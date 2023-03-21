<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Unfixeddate;
use App\Models\User;
use Illuminate\Http\Request;

class UnfixedDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unfixeddate = Unfixeddate::all();
        $users = User::all();
        return view('unfixeddate.index', compact('unfixeddate', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unfixeddate.create'); 
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
            'month'=> 'required',
            'week' => 'required',
            'day' => 'required',
            'frequency' => 'required',
        ]);

        $unfixeddate = new Unfixeddate();
        $unfixeddate->details = $request->input('details');
        $unfixeddate->webhook = $request->input('webhook');
        $unfixeddate->month = $request->input('month');
        $unfixeddate->week = $request->input('week');
        $unfixeddate->day = $request->input('day');
        $unfixeddate->frequency = $request->input('frequency');
        $unfixeddate->save();

        return redirect()->route('unfixeddate.index')
            ->with('success','Reminder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carbonTime = Carbon::now()->toDateTimeString();
        $results = Unfixeddate::find($id);
        return view('unfixeddate.show', compact('results', 'carbonTime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unfixeddate $unfixeddate)
    {
        return view('unfixeddate.edit', compact('unfixeddate'));
    }

    public function update(Request $request, Unfixeddate $unfixeddate)
    {
        $request->validate([
            'details' => 'required',
            'webhook' => 'required',
            'month'=> 'required',
            'week' => 'required',
            'day' => 'required',
            'frequency' => 'required'
        ]);
        $input = $request->all();
<<<<<<< HEAD
=======
        

>>>>>>> d546735 (rebase main)
        $unfixeddate->update($input);
        return redirect()->route('unfixeddate.index')
            ->with('success','Reminder updated successfully.');
    }

    public function destroy(Unfixeddate $unfixeddate)
    {
        $unfixeddate->delete();
        return redirect()->route('unfixeddate.index')
            ->with('success','Reminder deleted successfully');
    }
}

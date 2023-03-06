<?php

namespace App\Http\Controllers;
use App\Models\FixedDate;
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
        return view('reminders.index', compact('fixeddate', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'frequency' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $reminderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $reminderImage);
            $filename = $reminderImage;
        } else {
            $filename = 'no-img.jpg';
        }
       

        $fixeddate = new Fixeddate();
        $fixeddate->details = $request->input('details');
        $fixeddate->webhook = $request->input('webhook');
        $fixeddate->startMonth = $request->input('startMonth');
        $fixeddate->startDay = $request->input('startDay');
        $fixeddate->endMonth = $request->input('endMonth');
        $fixeddate->endDay = $request->input('endDay');
        $fixeddate->image = $filename;
        $fixeddate->notif = $request->input('notif');
        $fixeddate->save();

        return redirect()->route('reminders.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;
use Carbon\carbon;
use App\Models\Unfixeddate;
use App\Models\User;
use Illuminate\Http\Request;

class UnfixedDateController extends Controller
{

    private function getUnfixeddate($search)
    {
        
        
        if( $search != null ) {
            if($search == "January" || $search == "january" || $search == "Jan" || $search == "jan" || $search == "JAN" || $search == "JANUARY"){
                $search = 1;
            }elseif($search == "February" || $search == "february" || $search == "Feb" || $search == "feb" || $search == "FEB" || $search == "FEBRUARY"){
                $search = 2;
            }elseif($search == "March" || $search == "march" || $search == "Mar" || $search == "mar" || $search == "MAR" || $search == "MARCH"){
                $search = 3;
            }elseif($search == "April" || $search == "april" || $search == "Apr" || $search == "apr" || $search == "APR" || $search == "APRIL"){
                $search = 4;
            }elseif($search == "May" || $search == "may" || $search == "MAY"){
                $search = 5;
            }elseif($search == "June" || $search == "june" || $search == "Jun" || $search == "jun" || $search == "JUN" || $search == "JUNE"){
                $search = 6;
            }elseif($search == "July" || $search == "july" || $search == "Jul" || $search == "jul" || $search == "JUL" || $search == "JULY"){
                $search = 7;
            }elseif($search == "August" || $search == "august" || $search == "Aug" || $search == "aug" || $search == "AUG" || $search == "AUGUST"){
                $search = 8;
            }elseif($search == "September" || $search == "september" || $search == "Sep" || $search == "sep" || $search == "SEP" || $search == "SEPTEMBER"){
                $search = 9;
            }elseif($search == "October" || $search == "october" || $search == "Oct" || $search == "oct" || $search == "OCT" || $search == "OCTOBER"){
                $search = 10;
            }elseif($search == "November" || $search == "november" || $search == "Nov" || $search == "nov" || $search == "NOV" || $search == "NOVEMBER"){
                $search = 11;
            }elseif($search == "December" || $search == "december" || $search == "Dec" || $search == "dec" || $search == "DEC" || $search == "DECEMBER"){
                $search = 12;
            }

            $unfixeddate = Unfixeddate::join('users', 'unfixeddates.user_id', '=', 'users.id')
                            ->where(function($q) use ($search) {
                            $q->Where('details', 'like', '%'.$search.'%')
                            ->orWhere('name', 'like', '%'.$search.'%')
                            ->orWhere('month', 'like', $search)
                            ->orWhere('week', 'like', $search)
                            ->orWhere('day', 'like', $search)
                            ->orWhere('year', 'like', $search)
                            ->orWhere('frequency', 'like', '%'.$search.'%');
                        })
                        ->orderBy('details', 'asc')
                        ->paginate(10);
            $unfixeddate->appends(['search' => $search]);
        } else {
            $unfixeddate = Unfixeddate::orderBy('details', 'asc')
                        ->paginate(10);
        }

        return $unfixeddate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->has('search') )
        $search = request('search');
    else
        $search = null;

    $unfixeddate = $this->getUnfixeddate($search);

    $users = User::all();
    return view('unfixeddate.index')
            ->with('unfixeddate', $unfixeddate)
            ->with('users', $users)
            ->with('search', $search);
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
            //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /**if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $reminderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $reminderImage);
            $filename = $reminderImage;
        } else {
            $filename = 'no-img.png';
        }*/
       
        $userID = auth()->user()->id;

        $unfixeddate = new Unfixeddate();
        $unfixeddate->details = $request->input('details');
        $unfixeddate->user_id = $userID;
        $unfixeddate->webhook = $request->input('webhook');
        $unfixeddate->year = Carbon::now()->year;
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

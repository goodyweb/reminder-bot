<?php

namespace App\Http\Controllers;
use Hash;
use Carbon\carbon;
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




    private function getFixeddate($search)
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

            $fixeddate = Fixeddate::where(function($q) use ($search) {
                            $q->Where('details', 'like', '%'.$search.'%')
                            //->orWhere('name', 'like', '%'.$search.'%')
                            //->orWhere('startMonth', 'like', $search)
                            //->orWhere('startDay', 'like', $search)
                            ->orWhere('endMonth', 'like', $search)
                            //->orWhere('endDay', 'like', $search)
                            ->orWhere('year', 'like', $search)
                            ->orWhere('frequency', 'like', '%'.$search.'%');
                        })
                        ->orderBy('details', 'asc')
                        ->paginate(10);
            $fixeddate->appends(['search' => $search]);
        } else {
            $fixeddate = Fixeddate::orderBy('details', 'asc')
                        ->paginate(10);
        }

        return $fixeddate;
    }


    public function index()
    {
        if ( request()->has('search') )
            $search = request('search');
        else
            $search = null;

        $fixeddate = $this->getFixeddate($search);

        $users = User::all();
        return view('fixeddates.index')
                ->with('fixeddate', $fixeddate)
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

        $userID = auth()->user()->id;
        

        $fixeddate = new Fixeddate();
        $fixeddate->user_id = $userID;
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
    public function show($id)
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

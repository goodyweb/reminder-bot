<?php

namespace App\Http\Controllers;

use App\Models\Countdowns;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountdownsController extends Controller
{

    public function index(Request $request)
    {
        $countdown = [];
        if($request->ajax()) {
            $countdown = Countdowns::all();
            return DataTables::of($countdown)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'"  class="btn btn-warning btn-sm editCountdown">Edit</a> ';
                    $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteCountdown">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('countdowns.show', compact('countdown'));
    }

    public function show(Request $request)
    {
        $countdown = [];
        if($request->ajax()) {
            $countdown = Countdowns::all();
            return DataTables::of($countdown)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'"  class="btn btn-warning btn-sm editCountdown">Edit</a> ';
                    $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteCountdown">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('countdowns.show', compact('countdown'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'event' => 'required',
            'date' => 'required',
            'time' => 'required'

        ]);


        Countdowns::updateOrCreate(
            ['id' => $request->id],
            [
                'title' => $request->title,
                'event' => $request->event,
                'date' => $request->date,
                'time' => $request->time
            ]
        );
        return response()->json(['success'=>'Countdown saved successfully.']);
    }


    public function edit(Request $request)
    {
        $where = [
            'id' => $request->id
        ];
        $countdown  = Countdowns::where($where)->first();
        return response()->json($countdown);

    }


    public function destroy(Request $request)
    {
        $countdown = Countdowns::where('id', $request->id)->delete();
        return response()->json([
            'success'=>'Countdown deleted successfully.'
        ]);
    }
}

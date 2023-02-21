<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Reminders;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
public function index()
{
    $reminders = Reminders::all();
    return view('dashboard', compact('reminders'));
}

public function create()
{
    return view('dashboard');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'description' => 'required',
        'webhook' => 'required',
        'footer' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $input = $request->all();
    if ($image = $request->file('image')) {
        $destinationPath = 'img/';
        $reminderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $reminderImage);
        $input['image'] = "$reminderImage";
    }
    Reminders::create($input);
    return redirect()->route('dashboard')
        ->with('success','Reminder created successfully.');
}

public function show(Reminders $reminder)
{
    return view('dashboard', compact('reminder'));
}

public function edit(Reminders $reminder)
{
    return view('dashboard', compact('reminder'));
}

public function update(Request $request, Reminders $reminder)
{
    $request->validate([
        'name' => 'required',
        'detail' => 'required'
    ]);

    $input = $request->all();
    if ($image = $request->file('image')) {
        $destinationPath = 'img/';
        $reminderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $reminderImage);
        $input['image'] = "$reminderImage";
    } else {
        unset($input['image']);
    }

    $reminder->update($input);
    return redirect()->route('dashboard')
        ->with('success','Reminder updated successfully.');
}

public function destroy(Reminders $reminder)
{
    $reminder->delete();
    return redirect()->route('dashboard')
        ->with('success','Reminder deleted successfully');
}
}

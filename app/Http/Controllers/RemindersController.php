<?php
namespace App\Http\Controllers;

use Carbon\carbon;
use App\Models\Reminders;
use App\Models\User;
use Illuminate\Http\Request;

class RemindersController extends Controller
{
    public function index()
    {
        $reminders = Reminders::all();
        $users = User::all();
        return view('reminders.index', compact('reminders', 'users'));
    }

    public function create()
    {
        return view('reminders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            'webhook' => 'required',
            'dateend'=> 'required',
            'footer' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $reminderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $reminderImage);
            $input['image'] = "$reminderImage";
        }
        Reminders::create($input);
        return redirect()->route('reminders.index')
            ->with('success','Reminder created successfully.');
    }

    public function show(Reminders $reminder)
    {
        return view('reminders.show', compact('reminder'));
    }

    public function edit(Reminders $reminder)
    {
        return view('reminders.edit', compact('reminder'));
    }

    public function update(Request $request, Reminders $reminder)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
            'webhook' => 'required',
            'footer' => 'required',
            'dateend'=> 'required'
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
        return redirect()->route('reminders.index')
            ->with('success','Reminder updated successfully.');
    }

    public function destroy(Reminders $reminder)
    {
        $reminder->delete();
        return redirect()->route('reminders.index')
            ->with('success','Reminder deleted successfully');
    }
}

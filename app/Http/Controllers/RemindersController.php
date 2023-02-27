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
            'type' => 'required',
            'type2' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $reminderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $reminderImage);
            $filename = $reminderImage;
        } else {
            $filename = 'no-img.png';
        }
       

        $reminder = new Reminders();
        $reminder->title = $request->input('title');
        $reminder->content = $request->input('content');
        $reminder->description = $request->input('description');
        $reminder->webhook = $request->input('webhook');
        $reminder->footer = $request->input('footer');
        $reminder->dateend = $request->input('dateend');
        $reminder->type = $request->input('type');
        $reminder->type2 = $request->input('type2');
        $reminder->user_id = auth()->user()->id;
        $reminder->image = $filename;
        $reminder->nitified = 0;
        $reminder->save();

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

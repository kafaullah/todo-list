<?php

namespace App\Http\Controllers;

use App\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $reminders = Reminder::all();
        return view('reminders')->with('reminders', $reminders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addReminder');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $reminder = new Reminder();

        if ($request->id != '') {
            $reminder = $reminder->findOrFail($request->id);
        }
        
        $reminder->name = $request->name;

        if ($reminder->save()) {
            return redirect('/reminders')->with('message', 'Reminder has been saved');
        } else {
            return back()->with('message', 'Error in saving data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function show(Reminder $reminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reminder = Reminder::find($id);
        return view('editReminder')->with('reminder', $reminder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reminder $reminder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Reminder::where('id', $id)->delete();

        if ($delete) {
            return back()->with('message', 'Reminder has been deleted successfully');
        } else {
            return back()->with('message', 'Error in deleting');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Events\SetReminder;
use App\Reminder;
use DB;
use Carbon\Carbon;
use App\UserData;

class TodoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return view('TodoList')->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reminders = Reminder::all();
        return view('addTodo')->with('reminders', $reminders);
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
            'name' => 'required|string|max:255',
            'reminder_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);

        $todo = new Todo();

        if ($request->id != '') {
            $todo = $todo->findOrFail($request->id);
        }
        
        $todo->name = $request->name;
        $todo->reminder_id = $request->reminder_id;
        $todo->start_date = $request->start_date;
        $todo->end_date = $request->end_date;

        if ($todo->save()) {
            // event(new SetReminder($todo));
            return redirect('/')->with('message', 'Tod has been saved');
        } else {
            return back()->with('message', 'Error in saving data');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        $reminders = Reminder::all();
        return view('editTodo')->with('todo', $todo)->with('reminders', $reminders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Get param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $delete = Todo::where('id', $id)->delete();

        if ($delete) {
            return back()->with('message', 'Todo has been deleted successfully');
        } else {
            return back()->with('message', 'Error in deleting');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrashTodoList()
    {
        $todos = Todo::onlyTrashed()->get();
        return view('trashTodoList')->with('todos', $todos);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Get Param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $todo = Todo::withTrashed()
        ->where('id', $id)
        ->restore();

        if ($todo) {
            return back()->with('message', 'Todo has been restored successfully');
        } else {
            return back()->with('message', 'Error in restoring');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Todo::where('id', $id)->forceDelete();

        if ($delete) {
            return back()->with('message', 'Todo has been deleted successfully');
        } else {
            return back()->with('message', 'Error in deleting');
        }
    }
}

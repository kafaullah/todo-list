<?php

namespace App\Http\Controllers;

use App\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addUserData');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'email' => 'required',
            'phone' => 'required',
        ]);

        $userData = new UserData();

        if ($request->id != '') {
            $userData = $userData->findOrFail($request->id);
        }
        
        $userData->user_id = $user->id;
        $userData->email = $request->email;
        $userData->phone = $request->phone;

        if ($userData->save()) {
            return redirect('/home')->with('message', 'Data has been saved');
        } else {
            return back()->with('message', 'Error in saving data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function show(UserData $userData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userData = UserData::find($id);
        return view('editUserData')->with('userData', $userData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserData $userData)
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
        $delete = UserData::where('id', $id)->delete();

        if ($delete) {
            return back()->with('message', 'Data has been deleted successfully');
        } else {
            return back()->with('message', 'Error in deleting');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrashItems()
    {
        $userData = UserData::onlyTrashed()->get();
        return view('trashUserData')->with('userData', $userData);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Get Param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $userData = UserData::withTrashed()
        ->where('id', $id)
        ->restore();

        if ($userData) {
            return back()->with('message', 'Data has been restored successfully');
        } else {
            return back()->with('message', 'Error in restoring');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = UserData::where('id', $id)->forceDelete();

        if ($delete) {
            return back()->with('message', 'Data has been deleted successfully');
        } else {
            return back()->with('message', 'Error in deleting');
        }
    }
}

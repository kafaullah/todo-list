<?php

namespace App\Http\Controllers;

use App\ReminderJob;
use Illuminate\Http\Request;

class ReminderJobController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReminderJob  $reminderJob
     * @return \Illuminate\Http\Response
     */
    public function show(ReminderJob $reminderJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReminderJob  $reminderJob
     * @return \Illuminate\Http\Response
     */
    public function edit(ReminderJob $reminderJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReminderJob  $reminderJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReminderJob $reminderJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReminderJob  $reminderJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReminderJob $reminderJob)
    {
        //
    }
}

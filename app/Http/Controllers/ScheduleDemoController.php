<?php

namespace App\Http\Controllers;

use App\Models\ScheduleDemo;
use Illuminate\Http\Request;

class ScheduleDemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demos = ScheduleDemo::all();
        return view('admin.demo.index', compact('demos'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:7,12|numeric',
            'company_name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $demo = new ScheduleDemo();

        $demo->name = $request->input('name');
        $demo->email = $request->input('email');
        $demo->phone = $request->input('phone');
        $demo->company_name = $request->input('company_name');
        $demo->message = $request->input('message');

        if ($demo->save()) {
            return redirect()->route('viewIndex')->with('message', 'Thank you for scheduling a demo!');
        }

        return redirect()->back()->with('error', 'Failed to schedule demo. Please try again.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScheduleDemo  $scheduleDemo
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleDemo $scheduleDemo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScheduleDemo  $scheduleDemo
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleDemo $scheduleDemo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScheduleDemo  $scheduleDemo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleDemo $scheduleDemo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScheduleDemo  $scheduleDemo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleDemo $scheduleDemo)
    {
        if ($scheduleDemo->delete()) {
            $this->alert('Success', 'Contact Removed Successfully', 'success');
            return redirect()->route('demo');
        }

        $this->alert('error', 'Something went wrong', 'danger');
        return redirect()->back();
    }
}

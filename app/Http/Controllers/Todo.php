<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Todo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = DB::table('todos')->get();
        return view('master', ['todos' => $todos]);
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
         // validate the form
        $request->validate([
            'task' => 'required|max:200'
        ]);

        // store the data
        DB::table('todos')->insert([
            'task' => $request->task
        ]);

        // redirect
        return redirect('/')->with('message','Task Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = DB::table('todos')->where('id', $id)->first();
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate the form
        $request->validate([
            'task' => 'required|max:200'
        ]);

        // update the data
        DB::table('todos')->where('id', $request->id)->update([
            'task' => $request->task
        ]);

        // redirect
        return redirect('/')->with('message','Data Update Successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete the todo
        DB::table('todos')->where('id', $id)->delete();

        // redirect
        return redirect('/')->with('message','Task Remove');
    }


    public function approve_task($id)
    {
        // delete the todo
        DB::table('todos')->where('id', $id)->update([
            'status' => 2
        ]);

        // redirect
        return redirect('/')->with('message', 'Task Approve!');
    }

}

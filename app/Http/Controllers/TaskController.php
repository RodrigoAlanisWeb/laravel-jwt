<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Task::all();

        if (count($data) > 1){
            return response()->json([
                'res' => $data,
            ],200);
        } else {
            return response()->json([
                'res' => 'FAILED',
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'res' => 'NO DISPONIBLE',
        ],404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);

        $tasks = Task::all();

        if ($tasks->last()){
            return response()->json([
                'res' => $tasks->last(),
            ],200);
        } else {
            return response()->json([
                'res' => "FAILED",
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($task) {
            return response()->json([
                'res' => $task,
            ],200);
        } else {
            return response()->json([
                'res' => 'FAILED',
            ],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return response()->json([
            'res' => 'NO DISPONIBLE',
        ],404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $save = $task->save();

        if ($save) {
            return response()->json([
                'res' => $task,
            ],200);
        } else {
            return response()->json([
                'res' => 'FAILED',
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'res' => 'DESTROYED'
        ],200);
    }
}

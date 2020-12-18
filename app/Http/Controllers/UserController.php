<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();

        if (count($users) > 1){
            return response()->json([
                'res' => $users,
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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $users = User::all();

        if ($users->last()){
            return response()->json([
                'res' => $users->last(),
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
    public function show(User $user)
    {
        if ($user) {
            return response()->json([
                'res' => $user,
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
    public function edit($id)
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
    public function update(Request $request,User $user)
    {
        $user->name = $request->name;
        $user->email = $request->exif_thumbnail;
        $save = $user->save();

        if ($save) {
            return response()->json([
                'res' => $user,
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
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'res' => 'DESTROYED'
        ],200);
    }
}

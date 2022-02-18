<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meet;
use App\Models\User;

class MeetController extends Controller
{
    public function show() {
        $meets = Meet::orderBy('created_at', 'desc')->with('forms')->get();

        return response() -> json($meets);
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'required|unique:meets',
            'content' => 'required',
            'view' => 'required',
        ]);

        # create meet
        $meet = Meet::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'view' => $request['view'],
            'user_id' => $request->user()['id'], # master
        ]);
        
        return response()->json(['meet' => $meet]);
    }

    public function update(Request $request, $id) {
        $meet = Meet::find($id);
        if(!$meet) 
            return response()->json(['message' => false], 404);
        
        $meet->update($request->all());

        return response()->json(['meet' => $meet]);
    }

    public function destory($id) {
        $meet = Meet::find($id);
        if(!$meet) 
            return response()->json(['message' => false], 404);
        
        $meet->delete();

        return response()->json(['message' => true]);
    }
}

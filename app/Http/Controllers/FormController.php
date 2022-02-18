<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meet;
use App\Models\User;
use App\Models\Form;
use App\Models\Manage;

class FormController extends Controller
{
    public function show() {
        $forms = Form::orderBy('created_at', 'desc')->get();
        
        return response() -> json($forms);
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'required|unique:forms',
            'total' => 'required',
            'addmission' => 'required',
            'meet_start' => 'required',
            'meet_end' => 'required',
            'apply_start' => 'required',
            'apply_end' => 'required',
            'meet_id' => 'required',
        ]);

        # create meet
        $form = Form::create([
            'title' => $request['title'],
            'total' => $request['total'],
            'addmission' => $request['addmission'],
            'meet_start' => $request['meet_start'],
            'meet_end' => $request['meet_end'],
            'apply_start' => $request['apply_start'],
            'apply_end' => $request['apply_end'],
            'meet_id' => $request['meet_id'],
        ]);
        if($form) {
            $manage = Manage::create([
                'user_id' => $request->user()['id'],
                'form_id' => $form['id'],
                'approval' => 'Y',
                'role' => 'M',
                'reason' => null,
            ]);
        }
        else {
            return response()->json(['message' => false], 404);
        }

        return response()->json(['form' => $form]);
    }

    public function update(Request $request, $id) {
        $form = Form::find($id);

        if(!$form) 
            return response()->json(['message' => false], 404);
        
        $form->update($request->all());

        return response()->json(['form' => $form]);
    }

    public function destory($id) {
        $form = Form::find($id);
        if(!$form) 
            return response()->json(['message' => false], 404);
        $manage = Manage::find($id);
        
        $form->delete();
        $Manage->delete();

        return response()->json(['message' => true]);
    }
}

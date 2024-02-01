<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test(Request $request)
    {
        return view('test');
    }

    public function validateDates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
        ], [
            'start.before' => 'The :attribute must be set before :date.',
            'end.after' => 'The :attribute must be set after :date.',
        ], [
            'start' => 'Start',
            'end' => 'End',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }


        return "ok";
    }
}

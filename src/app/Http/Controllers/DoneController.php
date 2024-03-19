<?php

namespace App\Http\Controllers;

class DoneController extends Controller
{
    public function getDone()
    {
        return view('done');
    }

    public function postDone()
    {
        return redirect('/');
    }
}

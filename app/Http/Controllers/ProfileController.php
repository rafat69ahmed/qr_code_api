<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    //
    public function profile($id = false)
    {
        if($id){
            return response()->json(User::where('id', $id)->get());
        } else {
            return response()->json(User::all());
        }
    }
}

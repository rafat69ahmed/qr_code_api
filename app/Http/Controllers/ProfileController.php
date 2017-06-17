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
    public function labooh(Request $request)
    {
            // $userType = 
            return response()->json($request->currentUser);
    }

    public function index()
    {
        // return view('admin');
        $user = User::where('userType', 'user')->get();
        $merchant = User::where('userType', 'merchant')->get();
        return view('admin', [
            'users'                  => $user,
            'merchants'              => $merchant
        ]);
        // return response()->json([$user,$merchant]); 
    }

    public function userDelete($id)
    {   
        User::findOrFail($id)->delete();
        return redirect('api/v1/test');
    }
    // public function merchantDelete($id)
    // {   
    //     User::findOrFail($id)->delete();
    //     return redirect('api/v1/test');
    // }



}

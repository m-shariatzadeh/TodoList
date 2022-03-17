<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','!=',auth()->id())->get();
        $response = response()->json(['users' => $users],200);
        return $response;
    }

//    public function test($id)
//    {
//        $array_id = explode(',', $id);
////        $array_id = array_values($explode_arr);
//        $user = User::whereIn('id',$array_id)->get();
//        $response = response()->json(['user' => $user],200);
//        return $response;
//    }
}

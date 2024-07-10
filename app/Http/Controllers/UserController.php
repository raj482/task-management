<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users  = User::where('id', '!=', $request->user()->id)->get();
        return response()->json(['data' => $users, 'status' => true, 'message' => 'fetch successfully'], 200);
    }
}

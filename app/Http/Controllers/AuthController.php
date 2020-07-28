<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|min:4|max:255',
            'password' => 'required|min:6',
		]);
        if ($v->fails()) return apiReturn($request->all(), 'Validation Failed', 'failed', [$v->errors()]);

        $request['password'] = Hash::make($request['password']);

        if(User::create($request->all())){
            return apiReturn($request->all(), 'Successfully Added!');
        } else {
            return apiReturn($request->all(), 'Failed to Create.', 'failed');
        }
    }

    public function login(Request $request)
    {
        // return $request->all();
        //validate incoming request

        $v = Validator::make($request->all(), [
            'username' => 'required|min:4',
            'password' => 'required|min:6',
        ]);
        if ($v->fails()) return apiReturn($request->all(), 'Validation Failed', 'failed', [$v->errors()]);

        $credentials = $request->only(['username', 'password']);
        // return $credentials;
        if (! $token = Auth::attempt($credentials)) {
            // return $credentials;
            return apiReturn($credentials, 'Unauthorized User', 'failed');
        }
        return apiReturn($token);
    }

    public function logout()
    {
        Auth::logout();

        return apiReturn([], 'Successfully logged out');
    }

    public function search(Request $request){

        // $users = User::orderBy('id', 'asc');
        $users = datatables()->of(User::query())->make(true);

        return apiReturn($users);
        // return response()->json($users);
    }
}

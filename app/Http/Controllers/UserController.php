<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Models\User;

class UserController extends Controller
{
    public function edit(UserEditRequest $request){
        $user_id = \Auth::user()->id;

        User::where('id', $user_id)->update([
            'name' => $request->name,
            'adress' => $request->adress,
            'tel' => $request->tel,
            'email' => $request->email,
        ]);

        return redirect()->route('home')->with('status', "編集完了しました");

    }
}

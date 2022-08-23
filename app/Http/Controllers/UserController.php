<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\Models\Register;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(UserEditRequest $request){
        $user_id = \Auth::user()->id;

        User::where('id', $user_id)->update([
            'name' => $request->name,
            'adress' => $request->adress,
            'tel' => $request->tel,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('status', "編集完了しました");

    }

    public function delete($id){
        Register::where('id', $id)
        ->update([
            'flg' => '1',
        ]);

        return redirect()->back()->with('status', "削除しました");
    }
}

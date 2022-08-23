<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Register;
use App\Models\Item;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;

class AdminController extends Controller
{

    /**
     * 講師情報編集
     */
    public function edit(UserEditRequest $request){

        User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'adress' => $request->adress,
            'tel' => $request->tel,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('status', "編集完了しました");
    }

    /**
     *
     */
}

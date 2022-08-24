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

    public function delete($id)
    {
        $backup = Register::where('id', $id)->first();//バッティングチェック用
        $query = Register::query();


        \DB::beginTransaction();

        try{
            Register::where('id', $id)
            ->update([
                'flg' => '1',//論理削除
            ]);
            $query->where('id', '!=', $id)
            ->where('week', $backup['week'])
            ->where('period', $backup['period'])
            ->where('room', $backup['room'])
            ->where('flg', '0');

            // dd($query);

            $count = $query->count();

            if($count == 1){//削除するとバッティングが解消される
                $query->update([
                    'check' => '0',
                ]);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with('status', "削除失敗");
        }


        return redirect()->back()->with('status', "削除しました");
    }
}

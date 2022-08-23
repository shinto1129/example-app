<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\Item;
use App\Models\Tool;
use Carbon\Carbon;


class RoomRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 教室登録
     */
    public function register(Request $request)
    {
        $user_id = \Auth::user()->id;
        $data = $request;
        $count = Item::get()->count();
        $register = Register::get();

        $check = 0; //重複チェックフラグ

         //重複チェック
        //  dd($register);
         foreach($register as $r){
            if($r->week == $data->week && $r->period == $data->period && $r->room == $data->room){
                $check = 1;
                break;
            }
        }
        // dd($check);
        \DB::beginTransaction();
        try{
            $id = Register::insertGetId([
                'user_id' => $user_id,
                'week' => $data->week,
                'period' => $data->period,
                'room' => $data->room,
                'created_at' => Carbon::now(),
                'check' => $check,
            ]);


            for($i = 1; $i <= $count; $i++){
                if(!empty($data['item'.$i])){
                    Tool::insert([
                        'register_id' => $id,
                        'item_id'     => $data['item'.$i],
                    ]);
                }
            }
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollback();
        }
        if($r->check === 0){
            Register::where('id', $r->id)
            ->update([
                'check' => $check,
            ]);
        }
        return redirect()->back()->with('status', '登録しました');


    }
}

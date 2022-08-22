<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\Item;
use App\Models\Tool;


class RoomRegisterController extends Controller
{
    /**
     * 教室登録
     */
    public function register(Request $request)
    {
        $user_id = \Auth::user()->id;
        $data = $request;
        $count = Item::get()->count();
        \DB::beginTransaction();
        try{
            $id = Register::insertGetId([
                'user_id' => $user_id,
                'week' => $data->week,
                'period' => $data->period,
                'room' => $data->room,
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
        return redirect()->route('calendar')->with('status', '登録しました');


    }
}

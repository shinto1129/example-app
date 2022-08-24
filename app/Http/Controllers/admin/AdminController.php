<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Register;
use App\Models\Item;
use App\Models\Room;
use App\Models\Tool;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Carbon;

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
     *登録情報編集
     */
    public function roomEdit(Request $request)
    {
        $data = $request;
        $backup = Register::where('id', $data->register_id)->first();//編集前のデータ
        $register = Register::get();
        $count = Item::get()->count();//ループ用にitemデータ
        $tool = Tool::where('register_id', $data->register_id)->get();//編集前の登録情報から使用道具取得
        $toolBox1 = 0;//編集後item選択数
        $toolBox2 = Tool::where('register_id', $data->register_id)->get()->count();//編集前item選択数
        $toolcheck = 0;//編集前編集後で選択されている項目が一致するかチェックする
        $check = 0; //バッティングチェック
        $checkcount = 0;

        //入力データチェック



        //編集されたかどうか確認



        //item以外のデータが一致するかどうか
        $checkdata = Register::where('id', $data->register_id)
                        ->where('week', $data->week)
                        ->where('period', $data->period)
                        ->where('room', $data->room)
                        ->count();

        //item選択数取得（編集後）
        for($i = 1; $i <= $count; $i++){
            if(!empty($data['item'.$i])){
                $toolBox1++;
            }
        }

        if($checkdata != 0){                    //item以外のデータが一致しているか
            if($toolBox1 == $toolBox2){     //編集前と編集後のitem選択数が同じかどうか
                foreach($tool as $t){
                    for($i = 1; $i <= $count; $i++){    //編集前編集後で選択された項目が一致しているか確認
                        if(!empty($data['item'.$i])){
                            $toolcheck++;
                            break;
                        }
                    }
                }
                if($toolBox1 == $toolcheck){    //もし選択項目が全て同じなら選択数と一致した数は同じになる
                    return redirect()->back()->with('status', '編集内容が見つかりませんでした');
                }
            }
        }

        //そもそも同じユーザで同じ時間、同じ曜日では登録できない
        $checkdataId = Register::where('user_id', $data->user_id)
                        ->where('week', $data->week)
                        ->where('period', $data->period)
                        ->first();
        // dd($data);
        if(!empty($checkdataId)){
            //アイテムだけの変更はできるようにする
            if($data->register_id != $checkdataId->id){
                return redirect()->back()->with('status', '同じユーザで、曜日、時限が同じデータは登録できません');
            }
        }

        DB::beginTransaction();

        try{
            //編集したらバッティングしているか確認
            foreach($register as $r){
                if($r->week == $data->week && $r->period == $data->period && $r->room == $data->room){
                    $check = 1;
                    break;
                }
            }
            Register::where('id', $data->register_id)->update([
                'week' => $data->week,
                'period' => $data->period,
                'room' => $data->room,
                'check' => $check, //バッティングチェック
            ]);

            //バッティングしていた場合元のデータのバッティングチェックも変更
            if($r->check === 0 && $check === 1){
                Register::where('id', $r->id)
                ->update([
                    'check' => '1',
                ]);
            };
            //編集前の使用itemは削除してから編集後の使用itemを挿入する
            Tool::where('register_id', $data->register_id)
            ->delete();
            for($i = 1; $i <= $count; $i++){
                if(!empty($data['item'.$i])){
                    Tool::insert([
                        'register_id' => $data->register_id,
                        'item_id' => $data['item'.$i],
                    ]);
                }
            }
            //元々バッティングしていたのか確認
            if($backup->check === 1){
                //もしバッティングが解消されていたら変更していない方のデータのバッティングチェックも変更しなければならない
                //編集前のデータとバッティングしていたデータを取得する
                foreach($register as $r){
                    if($r->week == $backup->week && $r->period == $backup->period && $r->room == $backup->room && $backup->id != $r->id){
                        break;
                    }
                }
                //他にバッティングしていないか確認する
                foreach($register as $re){
                    if($r->week == $re->week && $r->period == $re->period && $r->room == $re->room && $backup->id != $re->id && $r->id != $re->id){
                        //他にバッティングデータがあるなら変更する必要なし
                        DB::commit();
                        return redirect()->back()->with('status', '編集完了しましたバッティング解消できない');
                    }
                }
                //他にバッティング情報なし
                Register::where('id', $r->id)
                ->update([
                    'check' => '0',
                ]);
                DB::commit();
                return redirect()->back()->with('status', '編集完了しましたバッティング解消');
            }

            DB::commit();
            return redirect()->back()->with('status', '編集完了しました');

        }
        catch(\Exception $e){
            DB::rollback();
        return redirect()->back()->with('status', '編集できません');

        }
    }
}

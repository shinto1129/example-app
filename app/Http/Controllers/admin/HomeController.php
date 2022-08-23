<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Register;
use App\Models\Item;
use App\Models\Room;
use App\Models\Tool;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 登録一覧（カレンダー表記）
     */
    public function home()
    {
        $user = Auth::user();
        $register = Register::where('flg', '0')->get();
        $items = Item::get();
        $rooms = Room::get();

        return view('admin.home', compact('user', 'items', 'register', 'rooms'));
    }

    /**
     * 登録一覧（テーブル表記）
     */
    public function data()
    {
        //モーダル表示用教室名と道具名
        $itemData = Item::get();
        $rooms = Room::get();


        //登録情報（登録データとユーザ情報）
        $data = Register::leftJoin('users as u', 'registers.user_id', '=', 'u.id')
        ->leftJoin('rooms as r', 'registers.room', '=', 'r.id')
        ->select('registers.*', 'u.name as name', 'r.name as rname')
        ->where('flg', '0')
        ->paginate(15);

        //使用道具情報
        $items = Tool::leftJoin('items as i', 'tools.item_id', '=', 'i.id')->get();



        return view('admin.data', compact('rooms', 'data', 'items', 'itemData'));
    }

    /**
     * 講師一覧画面
     */
    public function user()
    {
        $user = User::get();
        return view('admin.user', compact('user'));
    }

    /**
     * 講師情報編集画面
     */
    public function edit($id){
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('admin.data', compact('user'));
    }

    /**
     * バッティングデータのみ表示
     */
    public function check()
    {
        //登録情報（登録データとユーザ情報）
        $data = Register::leftJoin('users as u', 'registers.user_id', '=', 'u.id')
        ->leftJoin('rooms as r', 'registers.room', '=', 'r.id')
        ->select('registers.*', 'u.name as name', 'r.name as rname')
        ->where('flg', '0')
        ->where('check', '1')
        ->paginate(15);

        //使用道具情報
        $items = Tool::leftJoin('items as i', 'tools.item_id', '=', 'i.id')->get();

        //モーダル表示用の道具と部屋の名前一覧
        $itemData = Item::get();
        $rooms = Room::get();

        return view('admin.data', compact('data', 'items', 'rooms', 'itemData'));
    }

    /**
     * 検索機能
     */

     public function select(Request $request)
     {

        $query = Register::query();

        //検索条件の値取得
        $week_id = $request->week_id;
        $period_id = $request->period_id;
        $room_id = $request->room_id;
        $user_id = $request->user_id;

        //中身があれば絞り込み
        if(!empty($week_id)){
            $query->where('week', $week_id);
        }
        if(!empty($period_id)){
            $query->where('period', $period_id);
        }
        if(!empty($room_id)){
            $query->where('room', $room_id);
        }
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }

        $data = $query->paginate(15);

        //使用道具情報
        $items = Tool::leftJoin('items as i', 'tools.item_id', '=', 'i.id')->get();

        //モーダル表示用の道具と部屋の名前一覧
        $itemData = Item::get();
        $rooms = Room::get();

        return view('admin.data', compact('data', 'items', 'rooms', 'itemData'));
      }
}

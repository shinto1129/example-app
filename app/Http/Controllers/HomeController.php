<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Register;
use App\Models\Item;
use App\Models\Room;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        $user = Auth::user();
        return view('user.home', compact('user'));
    }

    public function calendar()
    {
        $user = Auth::user();
        $register = Register::where('user_id', $user['id'])->where('flg', '0')->get();
        $items = Item::get();
        $rooms = Room::get();
        return view('user.calendar', compact('user', 'items', 'register', 'rooms'));


    }
}

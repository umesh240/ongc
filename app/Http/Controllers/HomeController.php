<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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
        $today = date('Y-m-d');
        $eventIds = DB::table('events')->where('actv_event', 1)->where('event_dateto', '<=', $today)->pluck('ev_id')->toArray();
        $eventExpired = DB::table('events')->whereIn('ev_id', $eventIds)->update(['actv_event' => 2]);
        $hotelExpired = DB::table('hotels')->whereIn('evv_id', $eventIds)->update(['actv_hotel' => 2]);

        $eventCntAll = DB::table('events')->count();
        $eventCntActv = DB::table('events')->where('actv_event', 1)->count();
        //$data['eventCnt'] = $eventCntAll.'/'.$eventCntActv;
        $data['eventCnt'] = $eventCntActv;

        $hotelCntAll = DB::table('hotels')->count();
        $hotelCntActv = DB::table('hotels')->where('actv_hotel', 1)->count();
        //$data['hotelCnt'] = $hotelCntAll.'/'.$hotelCntActv;
        $data['hotelCnt'] = $hotelCntActv;

        $usersCntAll = DB::table('users')->where('actv_status', 1)->count();
        $data['usersCnt'] = $usersCntAll;

        return view('dashboard', $data);
    }
}

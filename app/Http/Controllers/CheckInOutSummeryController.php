<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Users;
use App\Models\EventBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\Functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\ReportsController;

class CheckInOutSummeryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rpt = new ReportsController();
        $event_list = $rpt->eventList();
        $data['event_list'] = $event_list;
        return view('check_inout_summery', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $eventcd = $request->eventcd;
        $hotel_cd = @$request->hotel_cd;
        $data = [];
        // ->where('emp_hotel_cd', $hotel_cd)
        $report_data = EventBook::where('emp_event_cd', $eventcd)->where('status_in_htl', 1)
                    ->when($hotel_cd > 0, function ($query) use ($hotel_cd) {
                        $query->where('emp_hotel_cd', $hotel_cd);
                    })
                    ->with(['eventDetails', 'hotelDetails', 'categoryDetails'])
                    ->orderBy('check_in', 'asc')->get();
        $data['report_data'] = $report_data;
        $data['eventcd'] = $eventcd;
        $data['hotelcd'] = $hotel_cd;

        $rpt = new ReportsController();
        $event_list = $rpt->eventList();
        $data['event_list'] = $event_list;

        return view('check_inout_summery', $data);
    }
    public function indexRMA()
    {
        $rpt = new ReportsController();
        $event_list = $rpt->eventList();
        $data['event_list'] = $event_list;
        return view('room_availability', $data);
    }
    public function room_available(Request $request)
    {
        /*
         SELECT `hc`.`htl_cat_id`,`hc`.`htl_idd`,`hc`.`evv_id`,`hc`.`hotel_category`,`hc`.`room_level`,`ht`.`hotel_name`, `eb`.`check_in`, `eb`.`check_out`, `eb`.`share_room_with_empcd` 
FROM `hotels_category` as `hc` 
LEFT JOIN `hotels` as `ht` ON `hc`.`htl_idd` = `ht`.`htl_id` 
LEFT JOIN `event_books_emp` as `eb` ON `hc`.`htl_cat_id` = `eb`.`emp_hotel_cat_cd` 
WHERE `hc`.`evv_id` = 1 and `eb`.`emp_event_cd` = 1 and `eb`.`status_in_htl` = 1 and `hc`.`soft_delete_yn` = 0 
GROUP BY IF(`eb`.share_room_with_empcd IS NOT NULL, `eb`.share_room_with_empcd, `eb`.emp_ev_book_id)
ORDER BY `ht`.`hotel_name`, `eb`.`share_room_with_empcd` DESC

//// Final with date
SELECT count(`eb`.`emp_hotel_cat_cd`) AS `rows`, `hc`.`htl_cat_id`,`hc`.`htl_idd`,`hc`.`evv_id`,`hc`.`hotel_category`,`hc`.`room_level`,`ht`.`hotel_name`, MIN(`eb`.`check_in`) AS `check_in`, MAX(`eb`.`check_out`) AS `check_out`,
 `eb`.`share_room_with_empcd`
FROM `hotels_category` as `hc` 
LEFT JOIN `hotels` as `ht` ON `hc`.`htl_idd` = `ht`.`htl_id` 
LEFT JOIN `event_books_emp` as `eb` ON `hc`.`htl_cat_id` = `eb`.`emp_hotel_cat_cd` 
WHERE (  (`eb`.`check_in` is Null AND `eb`.`check_out` is null) OR ( 
           `eb`.`check_in` NOT BETWEEN '2023-12-05 15:20:00' AND '2023-12-07 15:00:00' 
           AND `eb`.`check_out` NOT BETWEEN '2023-12-05 15:20:00' AND '2023-12-07 15:00:00' 
       	) 
       	AND ( date(`eb`.`check_in`) > '2023-12-05 15:20:00' AND date(`eb`.`check_out`) < '2023-12-07 16:00:00')  
       	OR ( date(`eb`.`check_out`) < '2023-12-05 15:20:00') 
    ) 
	AND `hc`.`evv_id` = 1 and `eb`.`emp_event_cd` = 1 and `eb`.`status_in_htl` = 1 
    and `hc`.`soft_delete_yn` = 0 
GROUP BY IF(`eb`.share_room_with_empcd IS NOT NULL, `eb`.share_room_with_empcd, `eb`.emp_ev_book_id)
ORDER BY `ht`.`hotel_name`, `eb`.`share_room_with_empcd` DESC;
        */
        $eventcd = $request->eventcd;
        $hotel_cd = @$request->hotel_cd;
        $fr_date = @$request->fr_date;
        $fr_date = date('Y-m-d H:i:s', strtotime($fr_date));
        $to_date = @$request->to_date;
        $to_date = date('Y-m-d H:i:s', strtotime($to_date));

        $data = [];
/*
        $report_data = DB::table('hotels_category as hc')
                    ->select(DB::raw('count(eb.emp_hotel_cat_cd) as rows'), 'hc.htl_cat_id', 'hc.htl_idd', 'hc.evv_id', 'hc.hotel_category', 'hc.room_level', 'ht.hotel_name', DB::raw('MIN(eb.check_in) as check_in'), DB::raw('MAX(eb.check_out) as check_out'), 'eb.share_room_with_empcd')
                    ->leftJoin('hotels as ht', 'hc.htl_idd', '=', 'ht.htl_id')
                    ->leftJoin('event_books_emp as eb', 'hc.htl_cat_id', '=', 'eb.emp_hotel_cat_cd')
                    ->where(function($query) use ($fr_date, $to_date) {
                        $query->whereNull('eb.check_in')
                            ->whereNull('eb.check_out')
                            ->orWhere(function($query) use ($fr_date, $to_date) {
                                $query->whereNotBetween('eb.check_in', [$fr_date, $to_date])
                                    ->whereNotBetween('eb.check_out', [$fr_date, $to_date])
                                    ->orWhere(function($query) use ($fr_date, $to_date) {
                                        $query->whereDate('eb.check_in', '>', $fr_date)
                                            ->whereDate('eb.check_out', '<', $to_date);
                                    })
                                    ->orWhere(function($query) use ($fr_date, $to_date) {
                                        $query->whereDate('eb.check_out', '<', $fr_date);
                                    });
                            });
                    })
                    ->when($hotel_cd > 0, function ($query) use ($hotel_cd) {
                        $query->where('hc.htl_idd', $hotel_cd);
                        $query->where('eb.emp_hotel_cat_cd', $hotel_cd);
                    })
                    ->where('hc.evv_id', '=', $eventcd)->where('eb.emp_event_cd', '=', $eventcd)->where('eb.status_in_htl', '=', 1)->where('hc.soft_delete_yn', '=', 0)
                    ->groupBy(DB::raw('IFNULL(eb.share_room_with_empcd, eb.emp_ev_book_id)'))
                    ->orderBy('ht.hotel_name')->orderByDesc('eb.share_room_with_empcd')->get();
                    */
        $report_data = DB::statement("SELECT count(`eb`.`emp_hotel_cat_cd`) AS `rows`, `hc`.`htl_cat_id`,`hc`.`htl_idd`,`hc`.`evv_id`,`hc`.`hotel_category`,`hc`.`room_level`,`ht`.`hotel_name`, MIN(`eb`.`check_in`) AS `check_in`, MAX(`eb`.`check_out`) AS `check_out`,
 `eb`.`share_room_with_empcd`
FROM `hotels_category` as `hc` 
LEFT JOIN `hotels` as `ht` ON `hc`.`htl_idd` = `ht`.`htl_id` 
LEFT JOIN `event_books_emp` as `eb` ON `hc`.`htl_cat_id` = `eb`.`emp_hotel_cat_cd` 
WHERE (  (`eb`.`check_in` is Null AND `eb`.`check_out` is null) OR ( 
           `eb`.`check_in` NOT BETWEEN '2023-12-05 15:20:00' AND '2023-12-07 15:00:00' 
           AND `eb`.`check_out` NOT BETWEEN '2023-12-05 15:20:00' AND '2023-12-07 15:00:00' 
        ) 
        AND ( date(`eb`.`check_in`) > '2023-12-05 15:20:00' AND date(`eb`.`check_out`) < '2023-12-07 16:00:00')  
        OR ( date(`eb`.`check_out`) < '2023-12-05 15:20:00') 
    ) 
    AND `hc`.`evv_id` = 1 and `eb`.`emp_event_cd` = 1 and `eb`.`status_in_htl` = 1 
    and `hc`.`soft_delete_yn` = 0 
GROUP BY IF(`eb`.`share_room_with_empcd` IS NOT NULL, `eb`.`share_room_with_empcd`, `eb`.`emp_ev_book_id`)
ORDER BY `ht`.`hotel_name`, `eb`.`share_room_with_empcd` DESC") ;


                    
        $data['report_data'] = $report_data;
        $data['eventcd'] = $eventcd;
        $data['hotelcd'] = $hotel_cd;
        $data['frdate'] = $fr_date;
        $data['todate'] = $to_date;

        $rpt = new ReportsController();
        $event_list = $rpt->eventList();
        $data['event_list'] = $event_list;

        return view('room_availability', $data);
    }

    
}

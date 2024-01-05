<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;


if (! function_exists('dd')) {
    function dd($data, $de=0) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }
}
if (! function_exists('cacheClear')) {
    function cacheClear() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Cache::flush();
    }
}
if (! function_exists('dateConvert')) {
    function dateConvert($formet, $date) {
        return date($formet, strtotime($date));
    }
}
if (! function_exists('timeDifference')) {
    function timeDifference($startDate, $endDate = date('Y-m-d h:i:s')) {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        // Calculate the difference in seconds
        $difference = $endTimestamp - $startTimestamp;

        // Calculate the difference in days, hours, and minutes
        $days = floor($difference / (60 * 60 * 24));
        $difference -= $days * 60 * 60 * 24;
        $hours = floor($difference / (60 * 60));
        $difference -= $hours * 60 * 60;
        $minutes = floor($difference / 60);

        $dayDiff = '';
        if($days > 0){
            $dayDiff .= $days.($days > 1?' days':'day');
        }
        if($hours > 0){
            $dayDiff .= $hours.($hours > 1?' hrs':'hr');
        }
        $dayDiff .= $minutes.($minutes > 1?' mins':'mins');
        return $dayDiff;
    }
}
?>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Category;
class EventBook extends Model
{
    use HasFactory;

    protected $table = 'event_books_emp';
    public function userDetails()
    {
        return $this->belongsTo(User::class, 'emp_cd', 'id');
    }
    public function shareUserDetails()
    {
        return $this->belongsTo(User::class, 'share_room_with_empcd', 'id');
    }
    public function eventDetails()
    {
        return $this->belongsTo(Event::class, 'emp_event_cd', 'ev_id');
    }
    public function hotelDetails()
    {
        return $this->belongsTo(Hotel::class, 'emp_hotel_cd', 'htl_id');
    }
    public function categoryDetails()
    {
        return $this->belongsTo(Category::class, 'emp_hotel_cat_cd', 'htl_cat_id');
    }
}

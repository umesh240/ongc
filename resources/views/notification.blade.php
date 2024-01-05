
<style type="text/css">
.dropdown-menu-lg .dropdown-item {
    padding: 0.2rem 1rem 1.4rem 1rem !important;
}
</style>
<a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
  <i class="far fa-bell"></i>
  <span class="badge badge-warning navbar-badge text-bold">{{ @$notification_cnt }}</span>
</a>
@if(@$notification_cnt > 0)
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
  <span class="dropdown-item dropdown-header bg-warning text-bold" style="padding: 0.2rem 1rem !important;">{{ @$notification_cnt }} Notifications</span>
  <div class="dropdown-divider"></div>
  <div class="dropdownBody" style="max-height: 300px; overflow-y: auto;">
    @foreach($notification_list as $list)
    @php
      //$timeDifference = timeDifference($list->createDate);
      $startTimestamp = strtotime($list->createDate);
      $endTimestamp = strtotime(date('Y-m-d H:i:s'));

      // Calculate the difference in seconds
      $difference = $endTimestamp - $startTimestamp;

      // Calculate the difference in days, hours, and minutes
      $days = floor($difference / (60 * 60 * 24));
      $difference -= $days * 60 * 60 * 24;
      $hours = floor($difference / (60 * 60));
      $difference -= $hours * 60 * 60;
      $minutes = floor($difference / 60);

      $dayDiff = ' ';
      if($days > 0){
          $dayDiff .= $days.($days > 1?'days ':'day ');
      }
      if($hours > 0){
          $dayDiff .= $hours.($hours > 1?'hrs ':'hr ');
      }
      $dayDiff .= $minutes.($minutes > 1?'mins ':'mins ');

      $page = $list->notification_type == 'hotel'?'hotel':'driver';
    @endphp
    <a href="{{ route('employee.ae', ['ae' => $page, 'id' => $list->emp_cd, 'event_id' => $list->emp_ev_book_id]) }}" class="dropdown-item">
      <i class="fas fa-{{ $list->notification_type == 'hotel'?'building':'plane' }} mr-2"></i> {{ $list->name }} ({{ $list->event_name }})
      <p class="float-right text-muted text-sm w-100 text-right">{{ $dayDiff }}</p>
    </a>
    <div class="dropdown-divider"></div>
    @endforeach
  </div>
</div>
@endif
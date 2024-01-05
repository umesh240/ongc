
@php
   

@endphp
<div class="row routeUrl" data-routename="{{ route($routename) }}">
    <div class="col-sm-3">
        <div class="dataTables_length">
            Show
            <select class="custom-select custom-select-sm form-control form-control-sm listLength" style="width: auto;" onchange="searchRecords(this);">
                <option value="10" {{ ($list_length == 10)?'selected':'' }}>10</option>
                <option value="50" {{ ($list_length == 50)?'selected':'' }}>50</option>
                <option value="100" {{ ($list_length == 100)?'selected':'' }}>100</option>
                <option value="250" {{ ($list_length == 250)?'selected':'' }}>250</option>
                <option value="500" {{ ($list_length == 500)?'selected':'' }}>500</option>
                <!--<option value="1000" {{ ($list_length == 1000)?'selected':'' }}>1000</option>
                <option value="2000" {{ ($list_length == 2000)?'selected':'' }}>2000</option>-->
            </select>
            Entries
        </div>
    </div>
    <div class="col-sm-2">
    @if($routename == 'employee')   
        Level
        <select class="custom-select custom-select-sm form-control form-control-sm listLevel" style="width: auto;" onchange="searchRecords(this);">
            <option value="">Select Level</option>
            @foreach($level_list as $level)
            <option value="{{ $level->level }}" {{ $level->level == $level_code?'selected':'' }}>{{ $level->level }}</option>
            @endforeach
        </select>
    @endif 
    </div>
    <div class="col-sm-2 otherPage" data-pg="{{ @$routename }}">
    @if($routename == 'bookevent' || $routename == 'employee' || $routename == 'hotel')   
        Event
        <select class="custom-select custom-select-sm form-control form-control-sm listEvent" style="width: auto;" onchange="searchRecords(this);">
            <option value="">Select Event</option>
            @foreach($events_list as $event)
            <option value="{{ $event->emp_event_cd }}" {{ $event->emp_event_cd == $event_cd?'selected':'' }}>{{ $event->event_name }}</option>
            @endforeach
        </select>
    @endif 
    </div>
    <div class="col-sm-2">
    @if($routename == 'employee' && @$event_cd > 0)   
        Hotel
        <select class="custom-select custom-select-sm form-control form-control-sm listHotel" style="width: auto;" onchange="searchRecords(this);">
            <option value="">Select Hotel</option>
            @foreach($hotel_list as $hotel)
            <option value="{{ $hotel->htl_id }}" {{ $hotel->htl_id == $hotel_code?'selected':'' }}>{{ $hotel->hotel_name }}</option>
            @endforeach
        </select>
    @endif
    </div>
    <div class="col-sm-3">
        <div class="dataTables_filter float-right">
            <div class="btn-group">
                Search &nbsp;
                <input type="search" class="form-control form-control-sm listSearch" value="{{ @$list_search }}" placeholder=" Search here..." style="display: inline; width: auto;">
                <button type="button" class="btn btn-sm btn-success" title="Search" onclick="searchRecords(this);" style="width: 30px;"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function searchRecords(thiss) {
    var routeUrl = $('.routeUrl').attr('data-routename');
    var listLength = $('.listLength').val();
    var listSearch = $('.listSearch').val();
    var listEvent = $('.listEvent').val();
    var listEventUrl = '';
    var routename = $('.otherPage').attr('data-pg');
    if(routename == 'bookevent' || routename == 'employee' || routename == 'hotel'){    
        listEventUrl = "&event_code="+listEvent;
          if(routename == 'employee'){
            var listLevel = $('.listLevel').val();
            var listHotel = $('.listHotel').val();
            if(listLevel == undefined || listLevel == '' || listLevel == null){
                listLevel = '';
            }
            if(listHotel == undefined || listHotel == '' || listHotel == null || parseInt(listHotel) <= 0){
                listHotel = '';
            }
            listEventUrl = listEventUrl+"&level_code="+listLevel+"&hotel_code="+listHotel;;
          }  
        location = routeUrl+"?length="+listLength+"&search="+listSearch+listEventUrl;
    }else{
        location = routeUrl+"/"+listLength+"/"+listSearch;
    }
}
</script>


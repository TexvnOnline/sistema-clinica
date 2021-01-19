@extends('layouts.admin')
@section('title','Citas programadas')
@section('styles')
{!! Html::style('fullcalendar/packages/core/main.css') !!}
{!! Html::style('fullcalendar/packages/daygrid/main.css') !!}

{!! Html::style('fullcalendar/packages/timegrid/main.css') !!}
@endsection
@section('dropdown')
{{--  <a class="dropdown-item has-icon" href="{{route('backoffice.patient.schedule', $user)}}"><i class="fas fa-user-plus"></i> Agendar nueva cita</a>  --}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Citas programadas</h4>
                <div class="card-header-form">
                
                </div>
            </div>
            <div id="calendar" class="card-body">
               
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                   
                </nav>
            </div>
        </div>
    </div>

</div>


@endsection
@section('scripts')
{{--  {!! Html::script('fullcalendar/packages/core/main.js') !!}  --}}
{!! Html::script('fullcalendar/packages/core/main.min.js') !!}
{!! Html::script('fullcalendar/packages/interaction/main.js') !!}
{!! Html::script('fullcalendar/packages/daygrid/main.js') !!}

{!! Html::script('fullcalendar/packages/timegrid/main.js') !!}

<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        
       
        editable: false,
        eventLimit: true,
        events: {!! $appointments !!}
        
      });
  
      calendar.render();
    });
  
  </script>

@endsection

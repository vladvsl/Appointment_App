@extends('layouts.admin')
@section('content')
    <h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
    <div class="card">
        <div class="card-header">
            {{ trans('global.systemCalendar') }}
        </div>

        <div class="card-body">
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

            <div id='calendar'></div>
        </div>
    </div>



@endsection

@section('scripts')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function () {

            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                events: events,
                defaultView: 'agendaWeek',
                minTime: '09:00',
                maxTime: '21:00',
                businessHours:
                    [
                        {
                            start: '09:00',
                            end: '13:00',
                            dow: [1, 2, 3, 4, 5,]

                        },
                        {
                            start: '15:30',
                            end: '21:00',
                            dow: [1, 2, 3, 4, 5,]

                        }]

            })
        });
    </script>
@stop

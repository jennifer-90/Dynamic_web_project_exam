<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!--calendrier -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            if (calendarEl) { // Vérifiez si l'élément existe avant de créer le calendrier
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: [
                            @if(isset($events))
                            @foreach($events as $event)
                        {
                            title: '{{ $event->event_name }}',
                            start: '{{ $event->date }}T{{ $event->time }}',
                            url: '{{ route('event.show', ['event' => $event->id]) }}'
                        },
                        @endforeach
                        @endif
                    ]
                });
                calendar.render();
            }
        });
    </script>

</head>


<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">

    @auth
        @include('layouts.navigation')
    @endauth
    <!-- Page Heading -->
    @hasSection('header')
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @if( config('themes.bootswatch.theme') <> 'default' )
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.2/{{ config('themes.bootswatch.theme') }}/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .bg-primary-gradient-custom {
            background: rgb(9,107,255);
            background: linear-gradient(321deg, rgba(9,107,255,1) 0%, rgba(4,50,117,1) 100%);
        }
        .bg-transparent {
            background-color: transparent !important;
        }
        .dropdown-toggle-without-caret::after {
            content: none !important;
        }
        .hover-bg-darken:hover {
            background-color: rgba(0, 0, 0, 0.025) !important;
        }
        .form-label-optional::after {
            color: #BBB;
            content: "(Optional)";
            /* font-size: .75rem; */
            font-style: italic;
            margin-left: 0.25rem;
        }
    </style>
</head>
<body class="bg-body-secondary">
    @include('application.navbar')
    @include('application.navbar-menu')
    @include('application.sidebar-menu')
    
    <div class="container">
        <header class="mt-5 mb-4">
            @yield('header')
        </header>

        @yield('subheader')

        @include('application.alert-message')

        @yield('content')
    </div>
    <br>
    <br>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @include('application.scripts.bs-components')
    @include('application.scripts.bs-custom')
    @stack('scripts')
</body>
</html>

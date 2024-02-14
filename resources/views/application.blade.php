<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    {{-- Load Bootstrap theme --}}
    @if( config('themes.bootswatch.theme') <> 'bootstrap' )
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.2/{{ config('themes.bootswatch.theme') }}/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
    <style>
        .form-label-optional::after {
            color: var(--bs-tertiary-color);
            content: "(Optional)";
            margin-left: 0.1rem;
        }
    </style>
</head>
<body class="bg-body-secondary">

    @include('components.application.sidebar-canvas')
    @include('components.application.navbar')

    <div class="container-fluid" id="main">
        <header>
            @yield('header')
        </header>
        <br>

        @yield('after-header')

        @include('components.application.message')

        @yield('content')
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @include('components.application.scripts.bs-components')
    @include('components.application.scripts.bs-custom')
    @stack('scripts')
</body>
</html>

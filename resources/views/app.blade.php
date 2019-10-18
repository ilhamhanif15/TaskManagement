<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- <- bootstrap css --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>@yield('title','Laravel 5.8 Basics')</title>
    <style>
        .alert{
            z-index: 99;
            top: 60px;
            right:18px;
            min-width:30%;
            position: fixed;
            animation: slide 0.5s forwards;
        }
        @keyframes slide {
            100% { top: 30px; }
        }
        @media screen and (max-width: 668px) {
            .alert{ /* center the alert on small screens */
                left: 10px;
                right: 10px; 
            }
        }
    </style>
</head>
<body>
    {{-- That's how you write a comment in blade --}}
    
    @include('navbar')
    
    <main class="container mt-4">
        @yield('content')
    </main>
    @include('footer')
    <script src="{{asset('js/app.js')}}"></script> {{-- <- bootstrap and jquery --}}

    @if(session('status')) {{-- <- If session key exists --}}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}} {{-- <- Display the session value --}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <script>
        //close the alert after 3 seconds.
        $(document).ready(function(){
           setTimeout(function() {
              $(".alert").alert('close');
           }, 3000);
        });
    </script>
    
</body>
</html>
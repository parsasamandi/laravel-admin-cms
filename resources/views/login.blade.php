<!DOCTYPE html>
<html>
    {{-- Header --}}
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- Authentication --}}
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
        {{-- App --}}
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    
    <div class="wrapper">
        {{-- Login Form --}}
        <form action="{{url('post-login')}}" method="POST" id="logForm" class="login">
            {{ csrf_field() }}
            <p class="title">Log in</p>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address">
            <i class="fa fa-user"></i>
            <input type="password" name="password" id="inputPassword" placeholder="Password" />
            <i class="fa fa-key"></i>
            <!-- <a href="#">Forgot your password?</a> -->
            <button>
                <span class="state">Log in</span>
            </button>
        </form>
        <br>
        {{-- Error Message --}}
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger right-direction">
                <footer><a target="blank">{{ $message }}</a></footer>
            </div>
        @endif

    </div>
</html>
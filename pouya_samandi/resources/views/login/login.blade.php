<!DOCTYPE html>
<html>
<head>
    <link href="/css/auth.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="wrapper">
    <form action="{{url('post-login')}}" method="POST" id="logForm" class="login">
        {{ csrf_field() }}
        <p class="title">Log in</p>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address">
        @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
        @endif
        <i class="fa fa-user"></i>
        <input type="password" name="password" id="inputPassword" placeholder="Password" />
        @if($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
        @endif
        <i class="fa fa-key"></i>
        <!-- <a href="#">Forgot your password?</a> -->
        <button>
            <span class="state">Log in</span>
        </button>
    </form>
    <br>
    @if($message = Session::get('faliure'))
        <div class="alert alert-danger right-direction">
            <footer><a target="blank">{{ $message }}</a></footer>
        </div>
    @endif

</div>
</html>
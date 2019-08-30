@extends('templates.application')

@section('title')
    Lishe Pro - Login
@endsection

@section('header')
    <div class="logo"><a href="/"><img src="https://s3.us-east-2.amazonaws.com/lishepro/logo2.png" alt="LishePro logo"></a></div>
    <div class="nav-links">

        <div class="menu">
            <div class="menubar"></div><br />
            <div class="menubar ndChild"></div><br />
            <div class="menubar rdChild"></div><br />
            <div class="menubar"></div>
        </div>

        <a id="tools"><span class="tools">Dietary Assessment </span>Tools
            <div class="submenu">
                <a href="/weight-loss-gain-tracker">Weight Loss Tracker</a>
                <a href="/food-calorie-counter">Food Calorie Counter</a>
                {{--<a href="/online-food-diary">Online Food Diary</a>
                <a href="/diet-meal-planner">Diet Meal Planner</a>--}}
            </div>
        </a>
        <a href="/blog">Blog</a>
        <a href="/shop" class="shopLink">Shop</a>
        <a href="/about-us">About Us</a>
        <a href="/register" class="register">Register</a>
    </div>

@endsection

@section('content')

    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="loginWrapper">

        <h1 class="text-center">Log In</h1>

        <div class="col-6">
            <form method="POST" action="/login" id="loginForm" >
                @csrf

                <label for="email" class="large">E-Mail Address</label>

                <input id="email" type="email" placeholder="example@mymail.com" class="form-control" name="email" value="{{ old('email') }}" required autofocus><br />


                <label for="password" class="large">Password</label>

                <input id="password" type="password" class="form-control" name="password" required><br />


                <label class="large">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;Remember Me
                </label><br />

                <button type="submit" class="btn large">
                    Log In
                </button><br /><br />

                <a class="float-left Links" href="/forgot">
                    Forgot Your Password ?
                </a>

                <a class="float-right Links" href="/register">
                    Don't have an account ?
                </a>
                <br /><br />

            </form>
        </div>

        <div class="br">
            <br /><hr /><br />
        </div>

        <div class="col-6 float-right">
            <h4 class="text-center">or using</h4>
            <br />

            <button class="btn gplus socials" onclick="window.location.href='https://lishep.herokuapp.com/auth/redirect/google'">
                <i class="fab fa-google-plus-g " aria-hidden="true"></i>&nbsp;&nbsp;Google Plus <span class="account">Account</span>
            </button><br /><br />


            <button class="btn fbook socials" onclick="window.location.href='https://lishep.herokuapp.com/auth/redirect/facebook'">
                <i class="fab fa-facebook-f " aria-hidden="true"></i>&nbsp;&nbsp;Facebook <span class="account">Account</span>
            </button><br /><br />

            <button class="btn twitter socials" {{--onclick="window.location.href='https://lishep.herokuapp.com/auth/redirect/twitter'"--}}>
                <i class="fab fa-twitter "></i>&nbsp;&nbsp;Twitter <span class="account">Account</span>
            </button>&nbsp;
            <br /><br />
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>

@endsection
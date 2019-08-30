@extends('templates.application')

@section('title')
    Lishe Pro - Reset Password
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
        <a href="/login" class="login">Login</a>
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

        <h1 class="text-center">Reset Your Password ?</h1><br />

        <script>

            new Noty({
                text: 'Welcome back <strong>{{$user->firstname}} {{$user->lastname}}</strong>',
                type: 'info',
                theme: 'relax',
                layout : 'bottomRight',
                closeWith: ['click', 'button'],
                animation: {
                    open: 'animated bounceInRight', // Animate.css class names
                    close: 'animated bounceOutRight'
                }
            }).show();
        </script>
        <br /><br />

        <div class="col-9 center">
            <form method="POST" action="/reset" id="loginForm" >
                @csrf

                <label for="password" class="large">New Password</label>
                <input id="password" type="password" class="form-control" name="password" required><br />


                <label for="password-confirm" class="large">Confirm Password</label>
                <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required><br /><br />

                <input name="invisible" type="hidden" value="{{$user->id}}" />

                <button type="submit" class="btn large">
                    Reset Password
                </button><br /><br />

            </form>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

    </script>

@endsection
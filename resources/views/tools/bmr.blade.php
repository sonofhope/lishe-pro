@extends('templates.application')

@section('title')
    Lishe Pro - BMR Calculator
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

        @if(Auth::check())
            <a id="nots"><i class="notsIcon far fa-bell"></i>@if(count(Auth::user()->unreadNotifications))<sup>{{count(Auth::user()->unreadNotifications)}}</sup>@endif
                <div class="notifications">

                    @if(count(Auth::user()->unreadNotifications))
                        @foreach(Auth::user()->unreadNotifications as $notification)
                            @if(preg_match('/(.*)NewComment/', $notification->type, $match))

                                <a class="list-group-item" href="/blog/{{$notification->data['comment_link']}}?nots={{$notification->id}}">{{$notification->data['commenter']}} commented: {{substr($notification->data['comment'], 0, 7)}}...</a>

                            @endif
                            @if(preg_match('/(.*)NewReply/', $notification->type, $match))

                                <a class="list-group-item" href="/blog/{{$notification->data['reply_link']}}?nots={{$notification->id}}">{{$notification->data['replier']}} replied: {{substr($notification->data['reply'], 0, 7)}}...</a>

                            @endif
                        @endforeach
                    @else
                        <a>You have no notifications</a>
                    @endif
                </div>
            </a>
            <a href="/logout">Logout</a>
            <a class="topname" href="/account/{{Auth::user()->id}}">
                <i class="far fa-user"></i> {{Auth::user()->firstname}}
            </a>
        @else
            <a href="/login" class="login">Login</a>
            <a href="/register" class="register">Register</a>
        @endif
        @can('isAdmin')
            <a href="/admin-management">Administer</a>
        @endcan

    </div>

@endsection

@section('content')

    <div id="bmrWrapper">
        <div id="BMResults">

            @if(isset($bmr))

                <h3 class="text-center">Calculation Results</h3>
                <br />

                Your BMI value is <span class="bmr">{{$bmi}}</span>, your weight indicates you are <span class="bmr">{{$bmiStatus}}</span>
                <br><br>

                <img src="https://s3.us-east-2.amazonaws.com/lishepro/bmi2.png" alt="BMI Scale" style="display:block;width: 70%; height: auto;margin-left:15%"><br><br>

                <span class="results rez">The amount of calories per day required to maintain your current weight is:  <span class="bmr">{{$bmr}}</span></span>
                <br ><br><br>
            
                <span class="discoverLink">WEIGHT GOAL</span>

                <br>

                <div id="tracker">

                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h4 class="text-center">A reduction of 500kcal daily results to a weight loss of about 05.kg a week.</h4><br />
                    <form method="POST" action="/weight-loss">
                    {{csrf_field()}}

                        <label for="target">Amount of Weight to Lose</label>
                        <input id="target" name="target" type="number" step="any" placeholder="in kilograms..." required>
                        <br><br>

                        <label for="days">Number of Days</label>
                        <input type="number" name="days" id="days" required>
                        <br><br>

                        <input type="hidden" value="{{$bmr}}" name="maintain">

                        <button type="submit">Track Me</button>
                        <br><br>

                    </form>

                </div>

            @endif

            @if(isset($deficit))

                    <script>
                        document.getElementById('tracker').style.display='none'
                    </script>

                <h3 class="text-center">Weight Tracking Results</h3>
                <br />

                The amount of calories you need to burn is <span class="bmr">{{$burnStatus}}</span>
                <br><br>

                <span class="results rez">The calories per day required to reach your goal weight is not more than:  <span class="bmr">{{$deficit}}</span></span>
                <br ><br><br>

            @endif

        </div>

        <div id="BMRForm">

            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h3 class="text-center">Calculate Your Daily Caloric Needs</h3><br />
            <form method="POST" action="/weight-loss-gain-tracker">
                {{csrf_field()}}

                <input type="radio" value="Female" id="female" name="sex"/>
                <label for="female"><span></span>Female</label>

                <input type="radio" value="Male" id="male" name="sex"/>
                <label for="male"><span></span>Male</label>
                <br /><br />

                <label for="height">Height</label>
                <input id="height" name="height" type="number" step="any" placeholder="in centimeters..." required/><br /><br />

                <label for="weight">Weight</label>
                <input id="weight" name="weight" type="number" step="any" placeholder="in kilograms..." required/><br /><br />

                <label for="age">Age</label>
                <input id="age" name="age" type="number" required/><br /><br />

                <label for="activity">Physical Activity</label><br>
                <select id="activity" name="activity">
                    <option value="sedentary">sedentary</option>
                    <option value="lightly active">lightly active</option>
                    <option value="moderately active">moderately active</option>
                    <option value="very active">very active</option>
                    <option value="extra active">extra active</option>
                </select><br /><br />

                <button type="submit">Calculate</button><br /> <br />
            </form>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function(){

            $('.discoverLink').click(function(){
                $('.discoverLink').css("display", "none");
                $('#tracker').css("display", "block");
            });

        });
    </script>

@endsection

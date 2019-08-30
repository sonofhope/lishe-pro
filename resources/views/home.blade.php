@extends('templates.application')

@section('title')
    Lishe Pro - Better Health Through Nutrition & Dietary Assesment Tools an Expertise
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
                <a id="dal" onclick="document.getElementById('dietassessmentmodal').style.display = 'block'">Weight Loss Tracker</a>
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

    <div id="dietassessmentmodal">

        <div class="dietassessment">
            <div id="x">
                <button onclick="document.getElementById('dietassessmentmodal').style.display='none'">&times;</button>
            </div>
            <div id="assessmentForm">

                @if(count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{--<h3 class="text-center">Weight Assesser</h3>--}}
                <form method="POST" action="/weight-loss-gain-tracker">
                    {{csrf_field()}}

                    <input type="radio" value="Female" id="female" name="sex"/>
                    <label for="female"><span></span>Female</label>

                    <input type="radio" value="Male" id="male" name="sex"/>
                    <label for="male"><span></span>Male</label>
                    <br /><br />

                    <label for="height">Height</label>
                    <input id="height" name="height" type="number" step="any" placeholder="in centimeters..." required/><br ><br >

                    <label for="weight">Weight</label>
                    <input id="weight" name="weight" type="number" step="any" placeholder="in kilograms..." required/><br ><br >

                    <label for="age">Age</label>
                    <input id="age" name="age" type="number" required/><br ><br >

                    <label for="activity">Physical Activity</label><br>
                    <select id="activity" name="activity">
                        <option value="sedentary">sedentary</option>
                        <option value="lightly active">lightly active</option>
                        <option value="moderately active">moderately active</option>
                        <option value="very active">very active</option>
                        <option value="extra active">extra active</option>
                    </select><br><br>

                    <button type="submit">Start Now</button><br /> <br />
                </form>
            </div>
        </div>

    </div>

@endsection

@section('content')

    <div id="homeWrapper">

        <div id="homeIntro">

            <div class="main-carousel">
                <div class="carousel-cell" style="background-image: url('https://s3.us-east-2.amazonaws.com/lishepro/diet.jpg');background-position: center top;">

                    <span class="heading">Fitness starts with what you eat.</span><br>

                    <span class="body">Take control of your goals, track your weights, calories, breakdown ingredients, and log activities with Lishe PRO.</span>

                    <button id="introButton" onclick="document.getElementById('dietassessmentmodal').style.display = 'block'">START FOR FREE</button>

                </div>

                <div  class="carousel-cell" style="background-image: url('https://s3.us-east-2.amazonaws.com/lishepro/antioxidant.jpg');background-position: center top;">

                    <span class="heading">Monitor your daily caloric requirements.</span><br>

                    <span class="body">With our tools you can track your BMI status, obtain your calorie intake, then begin your weight loss programme.</span>

                    <button id="introButton" onclick="document.getElementById('dietassessmentmodal').style.display = 'block'">START FOR FREE</button>

                </div>

                <div class="carousel-cell cell-3" style="background-image: url('https://s3.us-east-2.amazonaws.com/lishepro/bgsmall.jpg');background-position: left;">

                    <span class="heading">Calculate calories for almost any food.</span><br>

                    <span class="body">To effectively make your weight loss process a success, you need to know how many calories you eat daily.</span>

                    <button id="introButton" onclick="window.location.href='/food-calorie-counter'">EXPLORE</button>

                </div>
            </div>

        </div>

        <div id="whoAreWe">
            <h1 class="text-center">Dietary Assessment Tools</h1><br />

            <h3 class="text-center">Trying to lose weight, lower your BMI, or live a healthy lifestyle? Our tools will help to hit your goals</h3><br />

            <div class="hometools">

                <div class="weightLossTracker inl1" onclick="window.location.href='/weight-loss-gain-tracker'">
                    <h5>Weight Loss Tracker</h5>

                    If you've lost weight, increased exercising or made any significant changes in your lifestyle through eating and exercise, its time to modify your plan.

                    <br><br><span class="toolicon"><i class="fas fa-weight fa-4x"></i></span>
                    <span class="useNow"><a href="/weight-loss-gain-tracker">Use&nbsp;Tracker</a></span>
                </div>

                <div class="foodDiary inl1" onclick="window.location.href='/online-food-diary'">
                    <h5>Food Diary</h5>

                    If you want to keep a record of your daily food intake and stay on track when trying to lose weight or maintain a healthy weight and activity levels

                    <br><br><span class="toolicon"><i class="far fa-calendar-alt fa-4x"></i></span>
                    <span class="useNow"><a href="/online-food-diary">Use&nbsp;Food&nbsp;Diary</a></span>
                </div>

                <div class="foodCalorieCounter inl2" onclick="window.location.href='/food-calorie-counter'">
                    <h5>Food Calorie Counter</h5>

                    Powered by the Tanzania Food Composition Database, do you want to see nutrition facts such as calories, fat, protein, carbohydrates, fibre and sugars?

                    <br><br><span class="toolicon"><i class="fas fa-calculator fa-4x"></i></span>
                    <span class="useNow"><a href="/food-calorie-counter">Use&nbsp;Calorie&nbsp;Counter</a></span>
                </div>

                <div class="mpActivityPlanner inl2" onclick="window.location.href='/diet-meal-planner'">
                    <h5>Meal & Physical Activity Planner</h5>

                    Do you want to kick-start a healthier lifestyle by planning what you’ll eat, what you’ll drink and your physical activity, and monitor your progress?

                    <br><br><span class="toolicon"><i class="far fa-file-alt fa-4x"></i></span>
                    <span class="useNow"><a href="/diet-meal-planner">Use&nbsp;Planner</a></span>
                </div>

            </div>

        </div>
        <div id="whatWeDo">
            <h1>Lishe PRO-Well & Recipes</h1><br />

            <p>
                Get nutritionist-approved recipes and motivational workout tips from Lishe PRO experts. Lishe PRO provides a wellness engaged lifestyle facility. Individuals receive fitness and nutritional assessment and counseling based on their personal goals.
            </p> <br><br>
            
            <span class="raed"><a href="/blog">READ OUR ARTICLES</a></span>
        </div>
        <div id="loseIt">
            <h3>Loose Weight ONCE AND FOR ALL</h3><br />

            <p>
                Get access to basic tracking for free, or go Premium to get a personalized program and serious results. Lishe PRO believes that weight loss can be positive and transforming as its not just about losing weight, but getting the life-saving and life-altering benefits that come with it.
            </p>
            <br />

            <div id="weightLoss">

                <div id="basic">

                    <span class="loseHeader">LOSE&nbsp;IT!&nbsp;Basic</span><br><br>
                    <div class="frame">

                        <ul>
                            <li><i class="fas fa-check"></i>  Calorie Tracking</li>
                            <li><i class="fas fa-check"></i>  Exercise Tracking</li>
                        </ul>

                        <br><span class="getLoseIt"><a href="/basic">GET BASIC, $0/mo</a></span>
                    </div>

                </div>

                <div id="premium">

                    <span class="loseHeader">LOSE IT! Premium</span><br><br>
                    <div class="frame">

                        <ul>
                            <li><i class="fas fa-check"></i>	Calorie Tracking</li>
                            <li><i class="fas fa-check"></i>	Exercise Tracking</li>
                            <li><i class="fas fa-check"></i>	Macronutrient Goal Setting & Tracking</li>
                            <li><i class="fas fa-check"></i>	Nutrition Insight Reporting</li>
                            <li><i class="fas fa-check"></i>	Data Analysis & Recommendations</li>
                            <li><i class="fas fa-check"></i>	Meal Planning</li>
                            <li><i class="fas fa-check"></i>	Meal Plan, Recipe & Workout Library</li>
                            <li><i class="fas fa-check"></i>	Body Fat Percentage and Water Tracking</li>
                        </ul>

                        <br><span class="getLoseIt"><a href="/premium">GET PREMIUM, $5/mo</a></span>

                    </div>

                </div>

            </div>

        </div>
        <div id="contact">

            <div id="contactUs">

                <h2>Talk to Us</h2><br />
                <span class="contactUs">
                    Lishe Pro<br />
                    Kijitonyama Mabatini, PLOT NO. 755, BLOCK 47<br />
                    Dar Es Salaam.<br />
                    <i class="far fa-envelope-open"></i>&nbsp;info@lishepro.com<br />
                    <i class="fas fa-phone"></i>&nbsp; +255 767 423 804
                </span><br><br>

                <form id="msgForm" action="/msg" method="POST">
                    {{csrf_field()}}

                    <h3>Or Send a Quick Message</h3><br>

                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required><br><br>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required><br><br>

                    <label for="num">Phone Number</label>
                    <input type="text" name="num" id="num" required><br><br>

                    <label for="msg">Your Message</label><br><br>
                    <textarea name="msg" id="msg" cols="30" rows="10" required></textarea><br><br>

                    <button type="submit">Send Message</button>
                    <br><br>

                </form>
                <br>

            </div>
            <br>
            <div id="contactMap">

            </div>

        </div>
    </div>
@endsection

@section('scripts')

    <script>

        var mymap = L.map('contactMap', {
            center: [-6.781610, 39.234919],
            scrollWheelZoom: false,
            zoom: 17
        });
        var tiles = new L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mymap);

        var marker = L.marker([-6.781610, 39.234919]).addTo(mymap);
        marker.bindPopup("Lishe Pro").openPopup();

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        var flkty = new Flickity( '.main-carousel', {

            cellAlign: 'left',
            contain: true,
            autoPlay: 6500,
            prevNextButtons: false,
            pageDots: false

        });
    </script>

@endsection
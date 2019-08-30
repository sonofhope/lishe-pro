@extends('templates.application')

@section('title')
    Lishe Pro - Administration
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

    <div id="loginWrapper">

        <h1 class="text-center">Administration Panel</h1><br />

        <div class="container">
            <div class="row">

                <div class="col col-lg-6 col-md-12">
                    <h2 class="text-center">Users</h2>
                    <br />

                    <button class="listUsers" onclick="document.getElementById('listUsers').style.display='block'">List Users</button><br /><br />
                    <div id="listUsers">
                        <div class="card">
                            <div class="card-body">
                                @foreach($users as $user)
                                    @if($user->status)Verified @else NV @endif &nbsp;<strong><a href="/user/{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</a></strong>  {{$user->email}} @if($user->provider != null) | {{$user->provider}} @endif &nbsp; <a class="deleteIcon" href="/delete/user/{{base64_encode($user->id)}}"><i class="far fa-trash-alt"></i></a><br />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-6 col-md-12">
                    <h2 class="text-center">Articles</h2>
                    <br />

                    <button class="listArticles" onclick="document.getElementById('listArticles').style.display='block'">List Articles</button><br /><br />
                    <div id="listArticles">
                        <div class="card">
                            <div class="card-body">
                                @foreach($articles as $article)
                                    {{$article->created_at}} &nbsp;<strong><a href="/user/{{$article->user_id}}">{{$article->user->firstname}} {{$article->user->lastname}}</a></strong> &nbsp;<a class="article" href="/blog/{{str_replace(' ','-',$article->title)}}">{{$article->title}}</a> &nbsp; <a class="deleteIcon" href="/delete/article/{{base64_encode($article->id)}}"><i class="far fa-trash-alt"></i></a><br />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>

@endsection
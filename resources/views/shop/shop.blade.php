@extends('templates.application')

@section('stylesheets')
    <link rel="stylesheet" href="{{'/css/app.css'}}">
@endsection

@section('title')
    Lishe Pro - Shop
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
            <a href="/cart"><i class="fas fa-shopping-cart" style="font-family: 'FontAwesome'; color: #9BA747;"></i></a>
            <a href="/logout">Logout</a>
            <a class="topname" href="/account/{{Auth::user()->id}}">
                <i class="far fa-user"></i> {{Auth::user()->firstname}}
            </a>
        @else
            <a href="/cart"><i class="fas fa-shopping-cart" style="font-family: 'FontAwesome'; color: #9BA747;"></i></a>
            <a href="/login" class="login">Login</a>
            <a href="/register" class="register">Register</a>
        @endif
        @can('isAdmin')
            <a href="/admin-management">Administer</a>
        @endcan

    </div>

@endsection

@section('content')

    <div id="shopWrapper">

        <div id="shopNav">
            <ul class="navInl">
                <li><a href="#">SUPER FOODS</a></li>
                <li><a href="#">SAMPLE MENUS</a></li>
                <li><a href="#">BOOKS & EBOOKS</a></li>
                <li><a href="#">SUPPLEMENTS</a></li>
            </ul>

            <div class="dropdown navInl">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">SUPER FOODS</a>
                    <a class="dropdown-item" href="#">SAMPLE MENUS</a>
                    <a class="dropdown-item" href="#">BOOKS & EBOOKS</a>
                    <a class="dropdown-item" href="#">SUPPLEMENTS</a>
                </div>
            </div>

            <div id="searchBox" class="navInl">

                <form action="/shop" method="POST">
                    {{csrf_field()}}

                    <input class="input-" type="text" name="search" placeholder="Search..." required>
                    <button type="submit"><i class="fas fa-2x fa-search"></i></button>
                </form>
            </div>
        </div>

        <div id="shopIntro">

        </div>

        <div id="topSellr">

            <h2>Top Sellers</h2>

            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2013/11/13_29339-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Wings</h5>
                        <p class="card-text"><a href="/add_">Tsh 3999</a></p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2013/11/13_29339-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Wings</h5>
                        <p class="card-text"><a href="/add_">Tsh 3999</a></p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2013/11/13_29339-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Wings</h5>
                        <p class="card-text"><a href="/add_">Tsh 3999</a></p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2013/11/13_29339-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Wings</h5>
                        <p class="card-text"><a href="/add_">Tsh 3999</a></p>
                    </div>
                </a>
            </div>

        </div>

        <div id="topPicks">

            <h2>Top Picks</h2>

            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2014/09/15_6472-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Gelato</h5>
                        <p class="card-text"><a href="#">Tsh 5999</a></p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2014/09/15_6472-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Gelato</h5>
                        <p class="card-text"><a href="#">Tsh 5999</a></p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2014/09/15_6472-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Gelato</h5>
                        <p class="card-text"><a href="#">Tsh 5999</a></p>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="/item_name" class="card mb-3">
                    <img class="card-img-top" src="https://store.eatingfree.com/files/2014/09/15_6472-thumb.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Gelato</h5>
                        <p class="card-text"><a href="#">Tsh 5999</a></p>
                    </div>
                </a>
            </div>

        </div>

        <div id="shopFoot">

        </div>

    </div>

@endsection

@section('scripts')



@endsection
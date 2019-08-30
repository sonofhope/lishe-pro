@extends('templates.application')

@section('stylesheets')
    <link rel="stylesheet" href="{{'/css/app.css'}}">
@endsection

@section('title')
    Lishe Pro - Payment Processing
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


    <h1>Transaction Details</h1>
            <h3>PAYMENT RECEIVED</h3>
            <blockquote>
                Reload this page if the status is still on PENDING
                <b>Merchant reference: </b> {{$pesapalMerchantReference}}<br />
                <b>Pesapal Tracking ID: </b> {{$pesapalTrackingId}}<br />
                <b>Status: </b> {{$status}}<br />
            </blockquote>


@endsection


@extends('templates.application')

@section('stylesheets')

    <link rel="stylesheet" href="{{'/css/app.css'}}">

@endsection

@section('title')
    Lishe Pro - New Article
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

    <div id="blogWrapper">

        <div id="blogHead">
            <h2>Create New Article</h2>
        </div>
        <div id="blogSide">

            <h4 class="archToggle sideInline">Archives</h4>
            <div class="archLinks">
                @foreach($archives as $stat)
                    <a class="archLink large" href="/blog/?month={{$stat['month']}}&year={{$stat['year']}}">{{$stat['monthname'].' '.$stat['year']}}</a><br />
                @endforeach
            </div><br class="sideDel"/><br class="sideDel"/>

            <h4 class="archToggle2 sideInline">Tags</h4>
            <div class="archLinks2">
                @foreach($tags as $tag)
                    <a href="/tags/{{$tag}}" class="archLink large">{{$tag}}</a><br />
                @endforeach
            </div>

        </div>
        <div id="blogBod">

            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/articles" id="createForm">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" class="form-control" required/><br />
                </div>

                <div class="form-group">
                    <label for="bodyid">Body</label>
                    <textarea id="bodyid" name="body" class="form-control" ></textarea><br />
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select id="tags" name="tags[]" class="form-control" multiple="multiple">

                        @foreach($tagNames as $name)
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach

                    </select>
                </div><br />

                <div class="form-group">
                    <button type="submit" class="form-control createButton" id="createButton">
                        Post Article
                    </button>
                </div>
            </form>


        </div>

    </div>

@endsection

@section('scripts')

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js{{--?apiKey=your_API_key--}}"></script>
    <script>

        var editor_config = {
            selector:'textarea',
            menubar: false,
            plugins: 'lists image link',
            toolbar: 'formatselect | bold italic strikethrough | link image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            path_absolute: "/",
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win){
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name ;
                if (type == 'image'){
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x*0.8,
                    height: y*0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);

    </script>

@endsection
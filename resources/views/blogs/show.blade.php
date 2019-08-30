@extends('templates.application')

@section('stylesheets')
    <link rel="stylesheet" href="{{'/css/app.css'}}">
@endsection

@section('title')
    Lishe Pro - {{$posted->title}}
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
               {{-- <a href="/online-food-diary">Online Food Diary</a>
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

    <div><br />

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_inline_share_toolbox_wkp7"></div>

    </div>

    <div id="showWrapper">

        <div id="blogHead">

        </div>
        <div id="blogHeadSide">
            @can('isAdmin')
            <a class="sideInline" href="/article/create"><button> New Article </button></a>
            @endcan<br class="sideDel"/><br class="sideDel"/>

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
        <div id="blogSide">

            <div class="card w-100 border-success writer">

                <img class="card-img-top" src="https://s3.us-east-2.amazonaws.com/lishepro/sauli.jpg" alt="Sauli Epimack">
                <div class="card-body">
                    <h5 class="card-title">Sauli Epimack</h5>
                    <p class="card-text">
                        A nutritional epidemiologist with more than 5 years of experience as a nutritionist, a respected and trusted voice in the health and wellness industry in Tanzania. An educator, author, speaker.<br />
                        <span class="text-muted">Research Scientist, Ifakara University</span>
                    </p>
                </div>
            </div>
            <br class="sideDel"/>

            @can('isAdmin')
            <a href="/article/create"><button>New Article&nbsp; <i class="fas fa-plus"></i>&nbsp;</button></a>
            <br /><br />
            @endcan

            <h4>Archives</h4>
            @foreach($archives as $stat)
                <a href="/blog/?month={{$stat['month']}}&year={{$stat['year']}}" class="large">{{$stat['monthname'].' '.$stat['year']}}</a><br />
            @endforeach <br /><br />

            <h4>Tags</h4>
            @foreach($tags as $tag)
                <a href="/tag/{{$tag}}" class="large">{{$tag}}</a><br />
            @endforeach

        </div>
        <div id="blogBod">

            <h1>{{$posted->title}}</h1>
            <span class="articleTime"><b>{{$posted->user->firstname}} {{$posted->user->lastname}}</b> on {{$posted->created_at->toFormattedDateString()}}</span><br /><br />

            <span class="articleBod">{!! $posted->body !!}</span><br />

            <h6><i class="fas fa-tags"></i> Tags</h6><br />

            @foreach($posted->tags as $tag)
                <li class="tag"><a href="/tags/{{$tag->name}}"> {{$tag->name}} </a></li>&nbsp;&nbsp;
            @endforeach

            <br><br />

            <div class="card w-75" id="blogWriter">
                <img class="card-img-left" src="https://s3.us-east-2.amazonaws.com/lishepro/sauli.jpg" alt="Sauli Epimack">
                <div class="card-body">
                    <h5 class="card-title">Sauli Epimack</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Research Scientist, Ifakara University</h6>
                    <p class="card-text">A nutritional epidemiologist with more than 5 years of experience as a nutritionist, a respected and trusted voice in the health and wellness industry in Tanzania. An educator, author, speaker.</p>
                </div>
            </div>

            <br />
            <hr/>

            {{--<h3 class="text-center">Comments</h3>--}}

            <div id="comments">

                @if(count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/blog/{{str_replace(' ','-',$posted->title)}}/comment" method="POST" id="addComment">
                    {{csrf_field()}}
                    <h4>Say something about this article</h4>
                    <label for="newcomment"></label>

                    <textarea id="newcomment" type="text" class="form-control" name="body" placeholder="Login or register to comment" required></textarea>
                    <br />
                    <button type="submit" name="send" class="float-right">Add Comment</button>

                </form><br /><br />

                @if(count($posted->comments))

                    <ul class="list-group">
                    @foreach($posted->comments as $comment)

                        <li class="list-group-item">
                            <b class="text-left">{{$comment->user->firstname}} {{$comment->user->lastname}}</b>&nbsp;<span class="grey right"><i>{{$comment->created_at->diffForHumans()}}</i></span><br /><br />

                            <span class="medium">{{$comment->body}}</span><br />

                            <span class="right reply" data-toggle="tooltip" title="Reply" data-id="{{$comment->id}}"><i class="fas fa-reply"></i></span>

                        </li>

                        @if(count($comment->replies))

                                <ul class="list-group replies">
                                    @foreach($comment->replies as $reply)

                                        <li class="list-group-item">
                                            <b class="text-left">{{$reply->user->firstname}} {{$reply->user->lastname}}</b>&nbsp;&nbsp;<span class="grey"><i>replied</i></span>&nbsp;<span class="grey right"><i>{{$reply->created_at->diffForHumans()}}</i></span><br /><br />

                                            {{$reply->body}}<br />
                                        </li>
                                    @endforeach
                                </ul>
                        @endif

                            <form id="reply_{{$comment->id}}" class="commentReplyForm" method="POST" action="/blog/{{str_replace(' ','-',$posted->title)}}/reply">
                                {{csrf_field()}}

                                <label for="newreply" ></label>

                                <textarea id="newreply" type="text" class="form-control" name="body" placeholder="Your reply" required></textarea>
                                <br />

                                <input type="hidden" value="{{$comment->id}}" name="cid" />

                                <button type="submit" name="send" class="float-right">Reply</button><br />
                            </form>

                        <hr />
                    @endforeach
                    </ul>

                @endif


            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){

            $(".reply").click(function(){
                $id = $(this).data("id");

                $("#reply_"+$id).css('display', 'block');
            });

        });
    </script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b6ac1793196d3fc"></script>


@endsection
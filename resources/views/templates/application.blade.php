<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="shortcut icon" type="image/ico" href="https://s3.us-east-2.amazonaws.com/lishepro/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" href="{{'css/app.min.css'}}">
    <link rel="stylesheet" href="{{'/css/app.min.css'}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script src="{{'js/main.js'}}"></script>
    <script src="{{'/js/main.js'}}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

    {{--bootstrap js--}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


    @yield('stylesheets')
    <title>@yield('title')</title>
</head>
<body>

    <div id="contentWrapper">
        <div id="header">
            @yield('header')
        </div>

        <div id="content">

            @if(session()->has('loginsuccess'))
                <script>
                    new Noty({
                        text: '{{session('loginsuccess')}} {{Auth::user()->firstname}}',
                        type: 'info',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('regsuccess'))
                <script>
                    new Noty({
                        text: '<strong>{{session('regsuccess')}}</strong>. A link is sent to your email, click it to activate your account',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight', // Animate.css class names
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('accdel'))
                <script>
                    new Noty({
                        text: '{{session('accdel')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('accfail'))
                <script>
                    new Noty({
                        text: '{{session('accfail')}}',
                        type: 'error',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight', // Animate.css class names
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('outsuccess'))
                <script>
                    new Noty({
                        text: '{{session('outsuccess')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('adminerror'))
                <script>
                    new Noty({
                        text: '<strong>Disallowed...</strong>{{session('adminerror')}}',
                        type: 'error',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('userdel'))
                <script>
                    new Noty({
                        text: '{{session('userdel')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight', // Animate.css class names
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('userfail'))
                <script>
                    new Noty({
                        text: '<strong>{{session('userfail')}}</strong>',
                        type: 'error',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('postdel'))
                <script>
                    new Noty({
                        text: '{{session('postdel')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('postfail'))
                <script>
                    new Noty({
                        text: '<strong>{{session('postfail')}}</strong>',
                        type: 'error',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('commentsuccess'))
                <script>
                    new Noty({
                        text: '<strong>{{session('commentsuccess')}}</strong>',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight', // Animate.css class names
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('replysuccess'))
                <script>
                    new Noty({
                        text: '<strong>{{session('replysuccess')}}</strong>',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('articlesuccess'))
                <script>
                    new Noty({
                        text: '{{session('articlesuccess')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight', // Animate.css class names
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('socialerror'))
                <script>
                    new Noty({
                        text: '{{session('socialerror')}} <strong>Please </strong>login or register with a different account.',
                        type: 'error',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight' // Animate.css class names
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('updatesuccess'))
                <script>
                    new Noty({
                        text: '{{session('updatesuccess')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight', // Animate.css class names
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('mailsuccess'))
                <script>
                    new Noty({
                        text: '{{session('mailsuccess')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @if(session()->has('verified'))
                <script>
                    new Noty({
                        text: '{{session('verified')}}',
                        type: 'success',
                        theme: 'relax',
                        layout : 'bottomRight',
                        closeWith: ['click', 'button'],
                        animation: {
                            open: 'animated bounceInRight',
                            close: 'animated bounceOutRight'
                        }
                    }).show();
                </script>
            @endif

            @yield('content')
        </div>

        <div id="footer">
            <div class="text-center privacy"><br />
                <a href="/privacy">Privacy Policy</a>&nbsp;|&nbsp;<a href="/terms-of-service">Terms of Service</a>
            </div>
            <div class="footer">
                <span class="footblock">2018 &copy;Lishe Pro Tanzania</span>
                <span class="footblock">Crafted by <a href="http://www.bryceandy.com">BryceAndy</a></span>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TimelineMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @yield('scripts')

    <script type="text/javascript">
        $(document).ready(function(){

            $("#tools, .submenu").hover(function() {
                $('.submenu').addClass('display');
            }, function(){
                $('.submenu').removeClass('display');
            });

            $("#nots, .notifications").hover(function() {
                $('.notifications').addClass('display');
            }, function(){
                $('.notifications').removeClass('display');
            });

            $("#tools").click(function(){
                $(".submenu").toggleClass('display');
            });

            $("#nots").click(function(){
                $(".notifications").toggleClass('display');
            });

            $(".menu").click(function(){
                $(".nav-links").toggleClass('showMenu');
            });

            $(".archToggle, .archLinks").hover(function(){
                $('.archLinks').addClass('display');
            }, function(){
                $('.archLinks').removeClass('display');
            });

            $(".archToggle").click(function(){
                $('.archLinks').toggleClass('display');
            });

            $(".archToggle2, .archLinks2").hover(function(){
                $('.archLinks2').addClass('display');
            }, function(){
                $('.archLinks2').removeClass('display');
            });

            $(".archToggle2").click(function(){
                $('.archLinks2').toggleClass('display');
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>

    {{--<script src="{{'/js/main.js'}}"></script>--}}
    <script src="{{'js/main.js'}}"></script>

</body>
</html>
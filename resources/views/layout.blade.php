<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Chat - @yield('title')</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{\Illuminate\Support\Facades\URL::to('/')}}">Chat</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            @if (array_key_exists('username', View::getSections()))
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">@yield('username') <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('logout')}}">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>

<div class="container">

    @yield('content')

</div>

<script src="{{ elixir('js/app.js') }}"></script>
@yield('chat_script')
</body>
</html>


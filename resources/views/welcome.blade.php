<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div id="content" class="content">
                <div class="title m-b-md">

                </div>
                {{-- {{dd($string)}} --}}
                <div class="links">
                    <a id="js-getdata">Documentation</a>
                    <a href="https://www.instagram.com/oauth/authorize/?client_id=55cc1ce217eb43f7a8328d3bee0f3fec&redirect_uri=http://localhost:8089&response_type=token">Laracasts</a>
                    <a id="js-getposts">News</a>
                    <a id="js-getlogin">Forge</a>
                    <a id="js-getcode">GitHub</a>
                </div>
                {{ csrf_field() }}
                @if(!empty($data)){
                   {{dd($data)}}
                }
             @endif
            </div>
        </div>
        <script>
        document.getElementById('js-getposts').onclick = function(){
           getposts();
        };
        document.getElementById('js-getlogin').onclick = function(){
           getlogin();
        };
        document.getElementById('js-getdata').onclick = function(){
           @if(!empty($string)){
             gettokenbypost('{{$string}}');

          }
          @endif
        };

        document.getElementById('js-getcode').onclick = function(){
           return getcodefromurl();
        };

        function gettokenfromurl(){
           var url      = window.location.href;     // Returns full URL
           url = url.split('access_token=');
           var accesstoken = url[1];
           return accesstoken;
        }

        function gettokenbypost(code){
           window.location.href = "http://localhost:8089/gettoken/"+code;
        }

        function getcodefromurl(){
           var url      = window.location.href;     // Returns full URL
           url = url.split('code=');
           var accesstoken = url[1];
           return accesstoken;
        }

        function getposts(){
           var accesstoken = gettokenfromurl();
           $.ajax({
             url: "https://api.instagram.com/v1/users/self/?access_token=" + accesstoken,
             data: {
                format: "json"
             },
             error: function(){
                console.log("no response");
             },
             dataType: 'jsonp',
             success: function(data) {
                var container = $('#content');
                console.log(data);
             }
          });
        }

        function getlogin(){
           window.location.href = "https://api.instagram.com/oauth/authorize/?client_id=55cc1ce217eb43f7a8328d3bee0f3fec&redirect_uri=http://localhost:8089&response_type=code";
        }

        </script>
    </body>
</html>

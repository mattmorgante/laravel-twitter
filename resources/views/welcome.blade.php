<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            font-size: 24px;
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
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <form method="post" action="{{ route('start-twitter') }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            Please insert the URL of a tweet!<br>
            <input type="text" name="tweet">
            <br>
            <input type="submit" value="Submit">
        </form>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>
</body>
</html>
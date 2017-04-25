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
            font-size: 24px;
            height: 100vh;
            margin: 20px;
        }

        .full-height {
            height: 100vh;
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
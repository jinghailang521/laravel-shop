<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Shop') - Laravel 电商教程</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts._footer')
</div>

<!-- JS 脚本 -->
<script src="{{ mix('js/app.js') }}"></script>
@yield('scriptAfterJs')
<!-- helpdesk 3 widget -->
<script type="text/javascript">
    (function(w, d, s, u) {
        w.id = 3; w.lang = ''; w.cName = ''; w.cEmail = ''; w.cMessage = ''; w.lcjUrl = u;
        var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
        j.async = true; j.src = 'http://www.oss.com/js/jaklcpchat.js';
        h.parentNode.insertBefore(j, h);
    })(window, document, 'script', 'http://www.oss.com/');
</script>
<div id="jaklcp-chat-container"></div>
<!-- end helpdesk 3 widget -->
<div id="jaklcp-chat-container"></div>
<!-- end helpdesk 3 widget -->
</body>
</html>
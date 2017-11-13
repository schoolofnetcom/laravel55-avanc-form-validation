<html>
<head>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
</head>
<body>
<div class="row">
    <div class="container">
        <h1>Laravel: Formulários e Validações</h1>
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{Session::get('message')}}
            </div>
        @endif
        @yield('content')
    </div>
</div>

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>
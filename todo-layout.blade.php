<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo App</title>

    <link rel="stylesheet" href="{{ url(env('APP_DEBUG') ? 'css/frontend.css' : 'css/frontend.min.css') }}">
    <style>
        html, body {
            height: 100%;
        }
        body {
            background: #F5F5F5;
        }
    </style>
    @stack('styles')

</head>
<body>

<div class="content-wrapper">
    @yield('content')
</div>

<script src="{{ url(env('APP_DEBUG') ? 'js/vendor.js' : 'js/vendor.min.js') }}"></script>
<script>
    Vue.config.productionTip = false;
    Vue.component('ValidationObserver', VeeValidate.ValidationObserver);
    Vue.component('ValidationProvider', VeeValidate.ValidationProvider);
    VeeValidate.setInteractionMode('passive');
</script>
@stack('scripts')

</body>
</html>

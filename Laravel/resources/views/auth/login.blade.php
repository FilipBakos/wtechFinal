<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop-Uvod</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">



</head>
<body>

<!-- login -->
<article class="login">
    <div class="exit-wrapper">
        <a href="/" class="exit">&times;</a>
    </div>

    <h2 class="article-headline">Prihlásenie</h2>
    @if ($errors->any())
        <strong class="red">Zle zadané meno alebo heslo</strong>
    @endif
    {!! Form::open([ 'route' => 'login', 'class' => 'login-form']) !!}
        <div class="wrapper-login">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="text-field" placeholder="Email" value="{{ old('email') }}">

        </div>

        <div class="wrapper-login">
            <label for="password">Heslo</label>
            <input type="password" name="password" id="password" class="text-field" placeholder="Heslo" >
        </div>

        <div class="wrapper-submit">
            <input class="login-button" type="submit" value="Prihlásiť">
        </div>

        <div class="wrapper-submit">
            <a href="{{ route('register') }}" class="registrate">Registrácia</a>
        </div>
    {!! Form::close() !!}

</article>


{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>--}}
{{--<script src="js/script.js"></script>--}}

</body>
</html>



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

<!-- Registration -->
<article class="registration">
    <div class="exit-wrapper">
        <a href="/" class="exit">&times;</a>
    </div>

    <h2 class="article-headline">Registrácia</h2>
    {!! Form::open([
        'class' => 'registration-form'
    ]) !!}
    <h2 class="article-small-headline">Osobné údaje</h2>
    <div class="wrapper-registration">
        <label for="first_name">Meno</label>
        <input type="text" name="first_name" id="first_name" class="text-field" placeholder="Meno" value="{{ old('first_name') }}">
        @if ($errors->has('first_name'))
            <strong class="red">Zadajte meno</strong>
        @endif
    </div>

    <div class="wrapper-registration">
        <label for="second_name">Priezvisko</label>
        <input type="text" name="second_name" id="second_name" class="text-field" placeholder="Priezvisko" value="{{ old('second_name') }}" >
        @if ($errors->has('second_name'))
            <strong class="red">Zadajte priezvisko</strong>
        @endif
    </div>

    <div class="wrapper-registration">
        <label for="password">Heslo</label>
        <input type="password" name="password" id="password" class="text-field" placeholder="Heslo">
        @if ($errors->has('password'))
            <strong class="red">Zle heslo</strong>
        @endif
    </div>

    <h2 class="article-small-headline">Kontaktné údaje</h2>
    <div class="wrapper-registration">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="text-field" placeholder="E-mail" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <strong class="red">Tento email uz bol pouzity</strong>
        @endif
    </div>

    <div class="wrapper-registration">
        <label for="phone">Telefón</label>
        <input type="text" name="phone" id="phone" class="text-field" placeholder="Telefónne číslo" value="{{ old('phone') }}">
        @if ($errors->has('phone'))
            <strong class="red">Toto cislo uz bolo pouzite</strong>
        @endif
    </div>

    <h2 class="article-small-headline">Adresa</h2>
    <div class="wrapper-registration-large">
        <label for="street">Ulica</label>
        <input type="text" name="street" id="street" class="text-field" placeholder="Ulica" value="{{ old('street') }}">
        @if ($errors->has('street'))
            <strong class="red">Zadajte ulicu</strong>
        @endif
    </div>

    <div class="wrapper-registration-short">
        <label for="house_number">Číslo</label>
        <input type="text" name="house_number" id="house_number" class="text-field" placeholder="Č. domu" value="{{ old('house_number') }}">
        @if ($errors->has('house_number'))
            <strong class="red">Zadajte cislo domu</strong>
        @endif
    </div>

    <div class="wrapper-registration-large">
        <label for="city">Mesto</label>
        <input type="text" name="city" id="city" class="text-field" placeholder="Mesto" value="{{ old('city') }}">
        @if ($errors->has('city'))
            <strong class="red">Zadajte mesto</strong>
        @endif
    </div>

    <div class="wrapper-registration-short">
        <label for="psc">PSČ</label>
        <input type="text" name="psc" id="psc" class="text-field" placeholder="PSČ" value="{{ old('psc') }}">
        @if ($errors->has('psc'))
            <strong class="red">Zadajte PSC</strong>
        @endif
    </div>

    <div class="wrapper-submit">
        <input class="login-button" type="submit" id="registrate-button" value="Registrovať">
    </div>


    {!! Form::close() !!}
</article>


{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>--}}
{{--<script src="js/script.js"></script>--}}

</body>
</html>



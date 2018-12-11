@extends('master')

@section('content')

    @include('partials/categories')

    @include('flash::message')

    <a href="{{ URL::previous() }}" class="back-button">Späť</a>

    <h2 class="order-headline">Fakturačné údaje</h2>

    {!! Form::open([
        'url' =>'/order-methods',
        'class' => 'order-form'
    ]) !!}

    {{--<form action="platbaADoprava.html" class="order-form">--}}
        <div class="wrapper-order">
            <label for="first_name">Meno</label>
            <input type="text" name="first_name" id="first_name" class="text-field" placeholder="Meno" value="{{ $user->first_name }}">
        </div>

        <div class="wrapper-order">
            <label for="second_name">Priezvisko</label>
            <input type="text" name="second_name" id="second_name" class="text-field" placeholder="Priezvisko" value="{{ $user->second_name }}">
        </div>


        <div class="wrapper-order">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="text-field" placeholder="E-mail" value="{{ $user->email }}">
        </div>

        <div class="wrapper-order">
            <label for="phone">Telefón</label>
            <input type="text" name="phone" id="phone" class="text-field" placeholder="Telefónne číslo" value="{{ $user->phone }}">
        </div>

        <div class="wrapper-order-large">
            <label for="street">Ulica</label>
            <input type="text" name="street" id="street" class="text-field" placeholder="Ulica" value="{{ $user->street }}">
        </div>

        <div class="wrapper-order-short">
            <label for="house_number">Číslo</label>
            <input type="text" name="house_number" id="house_number" class="text-field" placeholder="Č. domu" value="{{ $user->house_number }}">
        </div>

        <div class="wrapper-order-large">
            <label for="city">Mesto</label>
            <input type="text" name="city" id="city" class="text-field" placeholder="Mesto" value="{{ $user->city }}">
        </div>

        <div class="wrapper-order-short">
            <label for="psc">PSČ</label>
            <input type="text" name="psc" id="psc" class="text-field" placeholder="PSČ" value="{{ $user->psc }}">
        </div>

        <div class="wrapper-submit-order">
            <input class="methods-button" type="submit" id="registrate-button" value="Spôsob platby a dopravy">
        </div>

    {!! Form::close() !!}
    {{--</form>--}}
    </div>

@endsection